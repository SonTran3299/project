* **Cài đặt Composer Dependencies:**
    ```bash
    composer install
    ```

* **Tạo file `.env`**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

* **Chạy Migrations (Tạo bảng trong Database):**
    ```bash
    php artisan migrate
    ```

* **Khởi động Laravel Development Server:**
    ```bash
    php artisan serve
    ```

* **Liệt kê tất cả các Route của ứng dụng:**
    ```bash
    php artisan route:list
    ```

* **Tạo Controller mới:**
    ```bash
    php artisan make:controller "Tên thư mục"\"Tên file phải có chứa chữ Controller"
    ```

* **Tạo Laravel Request mới:**
    ```bash
    php artisan make:request "Tên thư mục"\"Tên file phải có chứa chữ Request"
    ```

* **Thêm bảng mới (Migration):**
    ```bash
    php artisan make:migration Create_tên_bảng_table
    ```

* **Thêm cột mới vào bảng hiện có (Migration):**
    ```bash
    php artisan make:migration addColumnTenToBangTable
    ```

* **Rollback Migrations (Hoàn tác thay đổi database):**
    ```bash
    php artisan migrate:rollback --step=num
    ```
    (Để bỏ trống phần phía sau `rollback`, mặc định là 1 bước)

* **Các lệnh Git cơ bản:**
    * Kiểm tra trạng thái thay đổi:
        ```bash
        git status
        ```
    * Thêm tất cả các thay đổi vào staging area:
        ```bash
        git add .
        ```
    * Tạo commit với thông điệp:
        ```bash
        git commit -m "Thêm mô tả"
        ```
    * Đẩy các thay đổi lên GitHub (nhánh `main`):
        ```bash
        git push origin main
        ```

* **Chạy ứng dụng Laravel trên Localhost:**
    Để chạy ứng dụng và thấy giao diện, bạn cần mở hai terminal:
    * **Terminal 1:** Chạy Laravel Development Server:
        ```bash
        php artisan serve
        ```
    * **Terminal 2:** Chạy Vite Development Server (để biên dịch CSS/JS và hỗ trợ hot-reloading):
        ```bash
        npm run dev
        ```
