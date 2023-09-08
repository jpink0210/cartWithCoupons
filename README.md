
## 啟動方式

- php artisan key:generate
- composer install
- php artisan migrate --seed



## 程式邏輯

- 帳號初始化

這邊我綁在一起做，但是在設計思維上我會拆開
譬如用戶新增帳號，應該要先做驗證、開通，成功之後才會做幫她開帳戶、購物車的功能。
