import pandas as pd  # Membuat dataframe
import os  # digunakan untuk membatasi cpu yg digunakan oleh library
os.environ["LOKY_MAX_CPU_COUNT"] = "2"
import numpy as np
from sklearn.cluster import KMeans  # untuk modelling menggunakan kmeans
import matplotlib
matplotlib.use('Agg')  # Non-GUI mode
import matplotlib.pyplot as plt  # untuk membuat visualisasi scatter plot
from sklearn import tree  #untuk membangun visualisasi pohon keputusan
from sklearn.metrics import silhouette_score,classification_report, confusion_matrix, accuracy_score #matrix evaluasi
from sklearn.model_selection import train_test_split #membagi dataset untuk data test dan data train
from sklearn.tree import DecisionTreeClassifier #untuk modelling menggunakan decision tree
import io # Digunakan untuk operasi input/output
from flask import Flask, jsonify, request #framework python untuk aplikasi
import mysql.connector #menyambungkan database
from scipy.optimize import linear_sum_assignment #untuk menyusun data agar serupa 
import time #untuk foto menggunakan variable waktu/ timestamp

# Load environment variables
DB_USER = os.getenv("DB_USER", "root")
DB_PASSWORD = os.getenv("DB_PASSWORD", "")
DB_HOST = os.getenv("DB_HOST", "localhost")
DB_NAME = os.getenv("DB_NAME", "skripsibackup")

app = Flask(__name__)

# Function to create a new database connection
def create_connection():
    return mysql.connector.connect(
        user=DB_USER,
        password=DB_PASSWORD,
        host=DB_HOST,
        database=DB_NAME,
        use_pure=True,
        autocommit=True
    )

    
# Route untuk menjalankan KMeans dan memberikan hasil analisis
@app.route('/kmeans-process')
def kmeans_process():
    # Mendapatkan nilai n_clusters dari URL parameter GET
    php_cluster = 3  # Default 3 jika tidak ada parameter

    # print(f"Using n_clusters = {php_cluster}")  # Debugging log

    try:
        conn = create_connection()
        #Mengambil data dari database
        cur = conn.cursor()

        #Sql Query
        sql = "Select customer, total_qty, total_harga from dataset_km"
        cur.execute(sql)

        #Ambil data dan nama kolom
        dt = cur.fetchall()
        headers = [desc[0] for desc in cur.description]
        cur.close()
        #Buat dataframe
        df = pd.DataFrame(dt, columns=headers)

        #set index/ primary/ unique
        df.set_index(headers[0], inplace=True)

        # Ambil data untuk clustering
        x = df[['total_qty', 'total_harga']].values

        # Jalankan KMeans dengan n_clusters yang didapat dari URL parameter
        kmeans = KMeans(n_clusters=php_cluster, random_state=1)
        y_kmeans = kmeans.fit_predict(x)

        df['Cluster'] = y_kmeans

        # Kembalikan kolom 'customer' jika diatur sebagai index
        df.reset_index(inplace=True)
        
        # Hitung Silhouette Score
        sil_score = silhouette_score(x, kmeans.labels_)

        # Centroid hasil clustering
        centroids = kmeans.cluster_centers_

         # Buat DataFrame untuk centroid dan hitung total nilai
        centroid_df = pd.DataFrame(centroids, columns=['cen_total_qty', 'cen_total_harga'])
        centroid_df['total_value'] = centroid_df['cen_total_qty'] + centroid_df['cen_total_harga']
        
        # Urutkan centroid berdasarkan total nilai (descending)
        centroid_df.sort_values(by='total_value', ascending=False, inplace=True)

        # Mapping ulang cluster agar dimulai dari 1, bukan 0
        cluster_map = {old: new + 1 for new, old in enumerate(centroid_df.index)}
        df['Cluster'] = df['Cluster'].map(cluster_map)

        # Buat ulang centroid dalam urutan baru
        sorted_centroids = centroid_df[['cen_total_qty', 'cen_total_harga']].values

         # Scatter plot
        plt.figure(figsize=(8, 6))
        for cluster in range(1, php_cluster + 1):
            cluster_points = df[df['Cluster'] == cluster]
            plt.scatter(
                cluster_points['total_qty'], 
                cluster_points['total_harga'], 
                label=f"Cluster {cluster}"
            )
        # Centroids
        plt.scatter(centroids[:, 0], centroids[:, 1], c='red', marker='X', s=50, label="Centroids")
        plt.xlabel("Total Qty")
        plt.ylabel("Total Harga")
        plt.title("KMeans Clustering Scatter Plot")
        plt.legend()

        # Simpan plot ke file
        plot_path = r"C:\xampp\htdocs\cobapy\upload\scatter_plot.png"
        plt.savefig(plot_path)
        plt.close()

        # URL scatter plot
        scatter_plot_url = f"http://127.0.0.1/cobapy/upload/scatter_plot.png?ts={int(time.time())}"
        
        # Return hasil analisis dalam format JSON
        return jsonify({
            "n_clusters": php_cluster,
            "centroids": sorted_centroids.tolist(),
            "silhouette_score": sil_score,
            "df": df.to_dict(orient='records'),
            "scatter_plot_url": scatter_plot_url
        })
    except Exception as e:
        conn.close()
        print(f"Error: {str(e)}")  # Debugging log
        return jsonify({"error": str(e)}), 500

# Kmeans untuk perbandingan
@app.route('/perbandingan-kmeans-process')
def perbandingan_kmeans_process():
    # Mendapatkan nilai n_clusters dari URL parameter GET
    php_cluster = 3  # Default 3 jika tidak ada parameter

    print(f"Using n_clusters = {php_cluster}")  # Debugging log

    try:
        conn = create_connection()
        #Mengambil data dari database
        cur = conn.cursor()

        #Sql Query
        sql = "Select customer, total_qty, total_harga, label from dataset_dtnative"
        cur.execute(sql)

        #Ambil data dan nama kolom
        dt = cur.fetchall()
        headers = [desc[0] for desc in cur.description]
        cur.close()
        #Buat dataframe
        df = pd.DataFrame(dt, columns=headers)

        #set index/ primary/ unique
        df.set_index(headers[0], inplace=True)

        # Ambil data untuk clustering
        x = df[['total_qty', 'total_harga']].values

        # Jalankan KMeans dengan n_clusters yang didapat dari URL parameter
        kmeans = KMeans(n_clusters=php_cluster, random_state=1)
        y_kmeans = kmeans.fit_predict(x)

        df['Cluster'] = y_kmeans

        # Kembalikan kolom 'customer' jika diatur sebagai index
        df.reset_index(inplace=True)
        
        # Hitung Silhouette Score
        sil_score = silhouette_score(x, kmeans.labels_)

        # Centroid hasil clustering
        centroids = kmeans.cluster_centers_

         # Buat DataFrame untuk centroid dan hitung total nilai
        centroid_df = pd.DataFrame(centroids, columns=['cen_total_qty', 'cen_total_harga'])
        centroid_df['total_value'] = centroid_df['cen_total_qty'] + centroid_df['cen_total_harga']
        
        # Urutkan centroid berdasarkan total nilai (descending)
        centroid_df.sort_values(by='total_value', ascending=False, inplace=True)
        
        # Mapping ulang cluster agar dimulai dari 1, bukan 0
        cluster_map = {old: new + 1 for new, old in enumerate(centroid_df.index)}
        df['Cluster'] = df['Cluster'].map(cluster_map)

        # Buat ulang centroid dalam urutan baru
        sorted_centroids = centroid_df[['cen_total_qty', 'cen_total_harga']].values
          # Scatter plot
        plt.figure(figsize=(8, 6))
        for cluster in range(1, php_cluster + 1):
            cluster_points = df[df['Cluster'] == cluster]
            plt.scatter(
                cluster_points['total_qty'], 
                cluster_points['total_harga'], 
                label=f"Cluster {cluster}"
            )
        # Centroids
        plt.scatter(centroids[:, 0], centroids[:, 1], c='red', marker='X', s=50, label="Centroids")
        plt.xlabel("Total Qty")
        plt.ylabel("Total Harga")
        plt.title("KMeans Clustering Scatter Plot")
        plt.legend()

        # Simpan plot ke file
        plot_path = r"C:\xampp\htdocs\cobapy\upload\scatter_plot.png"
        plt.savefig(plot_path)
        plt.close()
        # URL scatter plot
        scatter_plot_url = f"http://127.0.0.1/cobapy/upload/scatter_plot.png?ts={int(time.time())}"
        # Confusion Matrix dan Akurasi
        ground_truth = df['label'].astype(int).values
        predicted = df['Cluster'].values
        # Ambil unique labels dari ground truth
        unique_labels = np.unique(ground_truth)

        # Filter hanya label yang ada di prediksi
        filtered_labels = [label for label in unique_labels if label in predicted]

        # Hitung akurasi setelah mapping
        adjusted_predicted = df['Cluster'].astype(int).values
        accuracy = accuracy_score(ground_truth, adjusted_predicted)

        # Confusion Matrix setelah mapping
        final_confusion = confusion_matrix(ground_truth, adjusted_predicted).tolist()

        # Hitung akurasi setelah mapping
        adjusted_predicted = df['Cluster'].values
        accuracy = accuracy_score(ground_truth, adjusted_predicted
        )
        # Convert confusion matrix ke dalam format yang lebih mudah dibaca
        confusion_list = [[int(val) for val in row] for row in final_confusion]

        # Masukkan labels ke dalam JSON
        labels = [int(label) for label in filtered_labels]
        
        conn.close()
        # Return hasil analisis dalam format JSON
        return jsonify({
            "n_clusters": php_cluster,
            "centroids": sorted_centroids.tolist(),
            "silhouette_score": sil_score,
            "accuracy": accuracy,
            "labels": labels,
            "confusion_matrix": confusion_list,
            "df": df.to_dict(orient='records'),
            "scatter_plot_url": scatter_plot_url
        })
    except Exception as e:
        conn.close()
        print(f"Error: {str(e)}")  # Debugging log
        return jsonify({"error": str(e)}), 500

# For Dataset Perbandingan
@app.route('/decision-tree', methods=['GET'])
def decision_tree():
    try:
        conn = create_connection()
        #Mengambil data dari database
        cur = conn.cursor()

        #Sql Query
        sql = "Select customer, total_qty, total_harga, label from dataset_dtnative ORDER BY total_harga ASC"
        cur.execute(sql)

        #Ambil data dan nama kolom
        dt = cur.fetchall()
        headers = [desc[0] for desc in cur.description]
        cur.close()
        #Buat dataframe
        dataset = pd.DataFrame(dt, columns=headers)
        
        # Mendapatkan nilai test_size dari parameter GET, default 0.4
        testSize = float(request.args.get('testSize', 0.4))  # Default test size 0.4

        # Mendapatkan nilai test_size dari parameter GET, default 0.4

        # Split dataset into features (X) dan labels (y)
        X = dataset.iloc[:, 1:-1].values  # Semua kolom kecuali pertama dan terakhir
        y = dataset.iloc[:, -1].values  # Kolom terakhir
    
        index_column = dataset['customer']  # Kolom indeks yang berisi identifier

        # Split data dan indeks
        X_train, X_test, y_train, y_test, train_idx, test_idx = train_test_split(
    X, y, index_column, test_size=testSize, random_state=42
)
    
        # Train Decision Tree
        model = DecisionTreeClassifier(max_depth=4, random_state=10)
        model.fit(X_train, y_train)

        #Pohon Keputusan
        plt.rcParams['figure.dpi'] = 85
        plt.subplots(figsize=(10,10))
        tree.plot_tree(model, fontsize=10)
        plt.show
        plot_path = r"C:\xampp\htdocs\cobapy\upload\tree_plot.png"
        plt.savefig(plot_path)
        plt.close()
        # URL tree_plot
        tree_plot_url = f"http://127.0.0.1/cobapy/upload/tree_plot.png?ts={int(time.time())}"

        # Predict and evaluate
        y_pred = model.predict(X_test)
        report = classification_report(y_test, y_pred,zero_division=0, output_dict=True)

        unique_labels = np.unique(y_test)
        # Filter hanya label yang ada di data test
        filtered_labels = [label for label in unique_labels if label in y_pred]
        # Generate confusion matrix
        confusion = confusion_matrix(y_test, y_pred, labels=filtered_labels)
        
        # Convert to DataFrame to handle missing values
        confusion_df = pd.DataFrame(confusion)

        # Fill missing values (e.g., with 0)
        confusion_df.fillna(0, inplace=True)

        # Convert back to list
        confusion = confusion_df.astype(int).values.tolist()

        #Menggabungkan data keseluruhan
        #2 fiture dari X train dan test
        train_df = pd.DataFrame(X_train, columns=['feature1', 'feature2'])
        test_df = pd.DataFrame(X_test, columns=['feature1', 'feature2'])

        #Menggabungkan X Test dan Train
        combined_traintest = pd.concat([train_df,test_df])
        combined_traintest.index.name = 'id_X'
        combined_traintest = combined_traintest.reset_index(drop=True)

        #Menggabungkan fitur Customer train dan test
        customer_field = pd.concat([train_idx, test_idx])
        customer_field = customer_field.reset_index(drop=True)
        customer_field.index.name = 'customer_id'

        #Penggabungan Fitur customer dan fitur X
        final_df = pd.concat([customer_field, combined_traintest], axis=1)

        #Tahapan pembuatan variabel datatest
        # Konversi y_train dan y_test menjadi pandas Series
        y_train_series = pd.Series(y_train)
        y_test_series = pd.Series(y_test)
        y_pred_series = pd.Series(y_pred)

        # Gabungkan kedua Series tersebut
        #Label awal
        labelCluster = pd.concat([y_train_series, y_test_series])
        #Label Prediksi
        labelPred = pd.concat([y_train_series, y_pred_series])

        #Mereset index agar mudah di gabungkan
        #Label Awal
        labelCluster = labelCluster.reset_index(drop=True)
        #Label Prediksi
        labelPred = labelPred.reset_index(drop=True)
        #Penggabungan label cluster dan prediksi
        final_label = pd.concat([labelCluster, labelPred], axis=1)
        #hasil akhir data keseluruhan
        outputData = pd.concat([final_df, final_label], axis=1)

        #datatest customer
        test_idx = test_idx.reset_index(drop=True)
        #datatest feature 1 dan 2
        test_df = test_df.reset_index(drop=True)
        labeltest = pd.concat([y_test_series, y_pred_series], axis =1)
        labeltest = labeltest.reset_index(drop=True)
        testX = pd.concat([test_idx, test_df], axis=1)
        testX = testX.reset_index(drop=True)

        #Gabungkan testX dan labelTest
        final_test = pd.concat([testX, labeltest],axis = 1)

        # Convert final dataframes to JSON
        output_data_json = outputData.to_json(orient="records")  # Menggunakan orient="records" agar mudah di-parse
        final_test_json = final_test.to_json(orient="records")  # Format JSON untuk final_test

        # Convert confusion matrix ke dalam format yang lebih mudah dibaca
        confusion_list = [[int(val) for val in row] for row in confusion]

        # Masukkan labels ke dalam JSON
        labels = [int(label) for label in filtered_labels]

        conn.close()

        # Return results
        return jsonify({
            "message": "Decision tree processed successfully",
            "testSize": testSize,
            "classification_report": report,
            "labels": labels, 
            "confusion_matrix": confusion_list,
            "outputData": output_data_json,  # Tambahkan outputData
            "finalTest": final_test_json,    # Tambahkan finalTest
            "tree_plot_url": tree_plot_url
        })

    except Exception as e:
        conn.close()
        print(f"Error: {str(e)}")  # Debugging log
        return jsonify({"error": str(e)}), 500

# For Dataset hasil K-Means
@app.route('/decision-tree-kombinasi', methods=['GET'])
def decision_tree_kombinasi():
    try:
        conn = create_connection()
        #Mengambil data dari database
        cur = conn.cursor()

        #Sql Query
        sql = "Select customer, total_qty, total_harga, label from dataset_dt ORDER BY total_harga ASC"
        cur.execute(sql)

        #Ambil data dan nama kolom
        dt = cur.fetchall()
        headers = [desc[0] for desc in cur.description]
        cur.close()
        #Buat dataframe
        dataset = pd.DataFrame(dt, columns=headers)
        
        # Mendapatkan nilai test_size dari parameter GET, default 0.4
        testSize = float(request.args.get('testSize', 0.4))  # Default test size 0.4

        # Mendapatkan nilai test_size dari parameter GET, default 0.4

        # Split dataset into features (X) dan labels (y)
        X = dataset.iloc[:, 1:-1].values  # Semua kolom kecuali pertama dan terakhir
        y = dataset.iloc[:, -1].values  # Kolom terakhir
    
        index_column = dataset['customer']  # Kolom indeks yang berisi identifier

        # Split data dan indeks
        X_train, X_test, y_train, y_test, train_idx, test_idx = train_test_split(
    X, y, index_column, test_size=testSize, random_state=42
)
    
        # Train Decision Tree
        model = DecisionTreeClassifier(max_depth=4, random_state=10)
        model.fit(X_train, y_train)

        #Pohon Keputusan
        plt.rcParams['figure.dpi'] = 85
        plt.subplots(figsize=(10,10))
        tree.plot_tree(model, fontsize=10)
        plt.show
        plot_path = r"C:\xampp\htdocs\cobapy\upload\tree_plot.png"
        plt.savefig(plot_path)
        plt.close()
        # URL tree_plot
        tree_plot_url = f"http://127.0.0.1/cobapy/upload/tree_plot.png?ts={int(time.time())}"

        # Predict and evaluate
        y_pred = model.predict(X_test)
        report = classification_report(y_test, y_pred,zero_division=0, output_dict=True)

        unique_labels = np.unique(y_test)
        # Filter hanya label yang ada di data test
        filtered_labels = [label for label in unique_labels if label in y_pred]
        # Generate confusion matrix
        confusion = confusion_matrix(y_test, y_pred, labels=filtered_labels)

        # Convert to DataFrame to handle missing values
        confusion_df = pd.DataFrame(confusion)

        # Fill missing values (e.g., with 0)
        confusion_df.fillna(0, inplace=True)

        # Convert back to list
        confusion = confusion_df.astype(int).values.tolist()

        #Menggabungkan data keseluruhan
        #2 fiture dari X train dan test
        train_df = pd.DataFrame(X_train, columns=['feature1', 'feature2'])
        test_df = pd.DataFrame(X_test, columns=['feature1', 'feature2'])

        #Menggabungkan X Test dan Train
        combined_traintest = pd.concat([train_df,test_df])
        combined_traintest.index.name = 'id_X'
        combined_traintest = combined_traintest.reset_index(drop=True)

        #Menggabungkan fitur Customer train dan test
        customer_field = pd.concat([train_idx, test_idx])
        customer_field = customer_field.reset_index(drop=True)
        customer_field.index.name = 'customer_id'

        #Penggabungan Fitur customer dan fitur X
        final_df = pd.concat([customer_field, combined_traintest], axis=1)

        #Tahapan pembuatan variabel datatest
        # Konversi y_train dan y_test menjadi pandas Series
        y_train_series = pd.Series(y_train)
        y_test_series = pd.Series(y_test)
        y_pred_series = pd.Series(y_pred)

        # Gabungkan kedua Series tersebut
        #Label awal
        labelCluster = pd.concat([y_train_series, y_test_series])
        #Label Prediksi
        labelPred = pd.concat([y_train_series, y_pred_series])

        #Mereset index agar mudah di gabungkan
        #Label Awal
        labelCluster = labelCluster.reset_index(drop=True)
        #Label Prediksi
        labelPred = labelPred.reset_index(drop=True)
        #Penggabungan label cluster dan prediksi
        final_label = pd.concat([labelCluster, labelPred], axis=1)
        #hasil akhir data keseluruhan
        outputData = pd.concat([final_df, final_label], axis=1)

        #datatest customer
        test_idx = test_idx.reset_index(drop=True)
        #datatest feature 1 dan 2
        test_df = test_df.reset_index(drop=True)
        labeltest = pd.concat([y_test_series, y_pred_series], axis =1)
        labeltest = labeltest.reset_index(drop=True)
        testX = pd.concat([test_idx, test_df], axis=1)
        testX = testX.reset_index(drop=True)

        #Gabungkan testX dan labelTest
        final_test = pd.concat([testX, labeltest],axis = 1)

        # Convert final dataframes to JSON
        output_data_json = outputData.to_json(orient="records")  # Menggunakan orient="records" agar mudah di-parse
        final_test_json = final_test.to_json(orient="records")  # Format JSON untuk final_test
        conn.close()

        # Convert confusion matrix ke dalam format yang lebih mudah dibaca
        confusion_list = [[int(val) for val in row] for row in confusion]

        # Masukkan labels ke dalam JSON
        labels = [int(label) for label in filtered_labels]

        # Return results
        return jsonify({
            "message": "Decision tree processed successfully",
            "testSize": testSize,
            "classification_report": report,
            "labels": labels, 
            "confusion_matrix": confusion_list,
            "outputData": output_data_json,  # Tambahkan outputData
            "finalTest": final_test_json,    # Tambahkan finalTest
            "tree_plot_url": tree_plot_url
        })

    except Exception as e:
        conn.close()
        print(f"Error: {str(e)}")  # Debugging log
        return jsonify({"error": str(e)}), 500

# For label K-Means (Dataset Perbandingan)
@app.route('/decision-tree-kombinasi-perbandingan', methods=['GET'])
def decision_tree_kombinasi_perbandingan():
    try:
        conn = create_connection()
        #Mengambil data dari database
        cur = conn.cursor()

        #Sql Query
        sql = "Select customer, total_qty, total_harga, label from dataset_kombinasipb ORDER BY total_harga ASC"
        cur.execute(sql)

        #Ambil data dan nama kolom
        dt = cur.fetchall()
        headers = [desc[0] for desc in cur.description]
        cur.close()
        #Buat dataframe
        dataset = pd.DataFrame(dt, columns=headers)
        
        #Mengambil data dari database
        cur = conn.cursor()

        #Sql Query
        sql2 = "Select customer, total_qty, total_harga, label from dataset_dtnative"
        cur.execute(sql2)

        #Ambil data dan nama kolom
        dt1 = cur.fetchall()
        headers1 = [desc[0] for desc in cur.description]
        cur.close()

        #Buat dataframe
        aktualData = pd.DataFrame(dt1, columns=headers1)
        
        # Mendapatkan nilai test_size dari parameter GET, default 0.4
        testSize = float(request.args.get('testSize', 0.4))  # Default test size 0.4

        # Mendapatkan nilai test_size dari parameter GET, default 0.4

        # Split dataset into features (X) dan labels (y)
        X = dataset.iloc[:, 1:-1].values  # Semua kolom kecuali pertama dan terakhir
        y = dataset.iloc[:, -1].values  # Kolom terakhir
    
        index_column = dataset['customer']  # Kolom indeks yang berisi identifier

        # Split data dan indeks
        X_train, X_test, y_train, y_test, train_idx, test_idx = train_test_split(
    X, y, index_column, test_size=testSize, random_state=42
)
    
        # Train Decision Tree
        model = DecisionTreeClassifier(max_depth=4, random_state=10)
        model.fit(X_train, y_train)

        #Pohon Keputusan
        plt.rcParams['figure.dpi'] = 85
        plt.subplots(figsize=(10,10))
        tree.plot_tree(model, fontsize=10)
        plt.show
        plot_path = r"C:\xampp\htdocs\cobapy\upload\tree_plot.png"
        plt.savefig(plot_path)
        plt.close()
        # URL tree_plot
        tree_plot_url = f"http://127.0.0.1/cobapy/upload/tree_plot.png?ts={int(time.time())}"
        
        # Predict and evaluate
        y_pred = model.predict(X_test)
        report = classification_report(y_test, y_pred,zero_division=0, output_dict=True)
        unique_labels = np.unique(y_test)
        # Filter hanya label yang ada di data test
        filtered_labels = [label for label in unique_labels if label in y_pred]
        # Generate confusion matrix
        confusion = confusion_matrix(y_test, y_pred, labels=filtered_labels)

        # Convert to DataFrame to handle missing values
        confusion_df = pd.DataFrame(confusion)

        # Fill missing values (e.g., with 0)
        confusion_df.fillna(0, inplace=True)

        # Convert back to list
        confusion = confusion_df.astype(int).values.tolist()

        #Menggabungkan data keseluruhan
        #2 fiture dari X train dan test
        train_df = pd.DataFrame(X_train, columns=['feature1', 'feature2'])
        test_df = pd.DataFrame(X_test, columns=['feature1', 'feature2'])

        #Menggabungkan X Test dan Train
        combined_traintest = pd.concat([train_df,test_df])
        combined_traintest.index.name = 'id_X'
        combined_traintest = combined_traintest.reset_index(drop=True)

        #Menggabungkan fitur Customer train dan test
        customer_field = pd.concat([train_idx, test_idx])
        customer_field = customer_field.reset_index(drop=True)
        customer_field.index.name = 'customer_id'

        #Penggabungan Fitur customer dan fitur X
        final_df = pd.concat([customer_field, combined_traintest], axis=1)

        #Tahapan pembuatan variabel datatest
        # Konversi y_train dan y_test menjadi pandas Series
        y_train_series = pd.Series(y_train)
        y_test_series = pd.Series(y_test)
        y_pred_series = pd.Series(y_pred)

        # Gabungkan kedua Series tersebut
        #Label awal
        labelCluster = pd.concat([y_train_series, y_test_series])
        #Label Prediksi
        labelPred = pd.concat([y_train_series, y_pred_series])

        #Mereset index agar mudah di gabungkan
        #Label Awal
        labelCluster = labelCluster.reset_index(drop=True)
        #Label Prediksi
        labelPred = labelPred.reset_index(drop=True)
        #Penggabungan label cluster dan prediksi
        final_label = pd.concat([labelCluster, labelPred], axis=1)
        #hasil akhir data keseluruhan
        outputData = pd.concat([final_df, final_label], axis=1)

        #datatest customer
        test_idx = test_idx.reset_index(drop=True)
        #datatest feature 1 dan 2
        test_df = test_df.reset_index(drop=True)
        labeltest = pd.concat([y_test_series, y_pred_series], axis =1)
        labeltest = labeltest.reset_index(drop=True)
        testX = pd.concat([test_idx, test_df], axis=1)
        testX = testX.reset_index(drop=True)

        #Gabungkan testX dan labelTest
        final_test = pd.concat([testX, labeltest],axis = 1)

        # Convert final dataframes to JSON
        output_data_json = outputData.to_json(orient="records")  # Menggunakan orient="records" agar mudah di-parse
        final_test_json = final_test.to_json(orient="records")  # Format JSON untuk final_test

        # Konversi aktualData ke dictionary
        actual_labels = aktualData.set_index('customer')['label'].to_dict()

        # Konversi JSON ke DataFrame
        output_df = pd.read_json(io.StringIO(output_data_json))
        
         # Urutkan output_df berdasarkan `customer`
        output_df = output_df.sort_values(by='customer').reset_index(drop=True)

        # Ambil label aktual berdasarkan `customer`
        output_df['actual_labels'] = output_df['customer'].map(actual_labels)

        # Tangani nilai NaN pada label aktual
        output_df['actual_labels'] = output_df['actual_labels'].fillna(-1)

        # Hitung confusion matrix dan akurasi
        y_actual = output_df['actual_labels']
        y_pred1 = output_df['1']
        unique_labels = np.unique(y_pred1)
        # Filter hanya label yang ada di data test
        filtered_labelskm = [label for label in unique_labels if label in y_pred1]
        adjusted_confusion = confusion_matrix(y_actual, y_pred1, labels=filtered_labelskm)
        adjusted_accuracy = accuracy_score(y_actual, y_pred1)
        # Convert confusion matrix ke dalam format yang lebih mudah dibaca
        confusion_list = [[int(val) for val in row] for row in confusion]

        # Masukkan labels ke dalam JSON
        labels = [int(label) for label in filtered_labels]
        # Convert confusion matrix ke dalam format yang lebih mudah dibaca
        confusion_list_adjust = [[int(val) for val in row] for row in adjusted_confusion]

        # Masukkan labels ke dalam JSON
        labels_adjust = [int(label) for label in filtered_labelskm]
        
        conn.close()
        # Return results
        return jsonify({
            "message": "Decision tree processed successfully",
            "testSize": testSize,
            "classification_report": report,
            "confusion_matrix": confusion_list,
            "labels": labels,
            "adjusted_confusion_matrix": confusion_list_adjust,
            "adjust_labels": labels_adjust,
            "adjusted_accuracy": adjusted_accuracy,
            "outputData": output_data_json,
            "finalTest": final_test_json,
            "tree_plot_url": tree_plot_url
        })

    except Exception as e:
        conn.close()
        print(f"Error: {str(e)}")  # Debugging log
        return jsonify({"error": str(e)}), 500

if __name__ == '__main__':
    app.run(debug=True, port=5000)
