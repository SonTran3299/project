#composer install

//Tạo (copy thư mục .env)
php artisan key:generate
php artisan migrate
php artisan serve
php artisan route:list
php artisan make:controller "Tên thư mục"\"Tên file phải có chứa chữ Controller"
//Tạo laravel Request
php artisan make:request "Tên thư mục"\"Tên file phải có chứa chữ Request"

//---Thêm bảng mới
php artisan make:migration Create_tên bảng_table
php artisan make:migration addColumnTenToBangTable
php artisan migrate:rollback --step=num  //bỏ trống phần phía sau rollback, mặc định là 1
//
git status
git add .
git commit -m "Thông điệp mô tả ngắn gọn về các thay đổi của bạn"
git push origin main
