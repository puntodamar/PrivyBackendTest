# Instalasi

1.) Install xampp [terbaru](https://www.apachefriends.org/download.html)

2.) Buka XAMPP, aktifkan Apache dan MySQL

3.) lakukan *clone* ke dalam folder `xampp/htdocs/privy`

4.) install laravel dengan perintah `composer install` pada terminal di folder privy

5.) buat database baru *(New)* bernama **'privy'** lewat URL http://localhost/phpmyadmin

6.) Lakukan *migration* dengan perintah `php artisan migrate`

7.) Lakukan *seeding* dengan perintah `php artisan db:seed` 
Jika *database* masih kosong maka lakukan *seeding* satu persatu **secara berurutan** :

 - `php artisan db:seed --class="CategoryTableSeeder"`
 - `php artisan db:seed --class="ProductTableSeeder"`
 - `php artisan db:seed --class="CategoryProductTableSeeder"`
 - `php artisan db:seed --class="ImageTableSeeder"`
 - `php artisan db:seed --class="ProductImageTableSeeder"`



# ENDPOINT
Untuk mencoba API endpoint digunakan [POSTMAN](https://www.getpostman.com/downloads/).  Masukkan URL dan *HTTP Request Method* seperti yang dicontohkan di bawah. Untuk endpoint selain GET Anda perlu memberikan body berupa data dengan format JSON. Sebelum dikirimkan, [cek validitas format JSON](https://jsonlint.com/). Untuk sementara sistem menganggap semua request adalah valid.
 
![enter image description here](https://lh3.googleusercontent.com/pw93Ti5w6IaZErMbGKe-LDnPdwA2t9yjvPheAaT3lVVLxvR9HcRWTYwYb7mxUZu5YM8ePpqY85k6)


## Category

 1. [GET] `/api/category`
Melihat seluruh kategori produk

 3. [POST] `/api/category`
 Menambahkan banyak kategori sekaligus. Data yang wajib diisikan adalah `name` dan `enable`. Contoh :

Contoh :

    {
    	"categories" : 
    	[
	    	{
		    	"name" : "kaos",
		    	"enable" : true
	    	},
	    	{
		    	"name" : "celana",
		    	"enable": false
	    	}
    	]
    }
    

 4. [DELETE] `/api/category/mass-delete`
Menghapus banyak kategori sekaligus. 
Data yang dikirimkan adalah `id` dari kategori yang ingin dihapus. 

Contoh :

    {
    	"category_ids" : [1,2,3,4]
    }



 5. [GET] `/api/category/{id}`
 Memilih sebuah kategori.
 
## Product

 6. [GET] `/api/product`
 Melihat seluruh produk
 
 7. [POST] `/api/product`
Menambahkan produk.
Data yang wajib diisikan adalah `name`, `description`, dan `enable`.
*Field* `category` ditambahkan jika ingin memberikan kategori pada produk.
*Field* *image* ditambahkan untuk menambahkan gambar produk.  Produk dapat memiliki gambar dengan jumlah tak terbatas. 
*Field* `file` adalah gambar yang sudah di-*encode* ke dalam format *base64*. Konversi dilakukan menggunakan lewat situs https://www.base64-image.de/

Contoh :

    {
    	"name" : "nama produk",
    	"description" : "lorem ipsum",
    	"enable" : true,
    	"category" : [1,2,3],
    	"image": [{
    		"name" : "nampak depan",
    		"file" : "data:image/jpeg;base64,/9j/4AA..."
    	}]
    }

 8. [GET] `/api/product/{id}`
 Melihat detail produk.
 
 9. [PATCH] /api/product/{id}
Melakukan update data produk.
Data yang wajib diberikan adalah `name`, `description`, dan `enable`.
*Field* `remove_image` diisikan untuk menghapus gambar *image*.
*Field* `new_image` diisikan untuk menambahkan gambar baru.

Contoh :

    {
    	"name" : "nama produk",
    	"description" : "lorem ipsum",
    	"enable" : true,
    	"remove_image" : [1,2,3],
    	"image": 
    	[
	    	{
	    		"name" : "nama gambar 1",
	    		"file" : "data:image/jpeg;base64,/9j/4AA..."
	    	},
		    	{
	    		"name" : "nama gambar 2",
	    		"file" : "data:image/jpeg;base64,/9j/4AA..."
	    	},    	
    	]
    }
    
 10. [DELETE] /api/product/{id}
 Menghapus produk
 