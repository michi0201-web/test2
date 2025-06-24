Dockerビルド
1.DockerDesktopアプリを立ち上げる
2.docker-compose up -d --build


Laravel環境構築
1.docker-compose exec php bash
2.composer install
3.「.env.example」ファイルを 「.env」ファイルに命名を変更。または、新しく.envファイルを作成
4..envに以下の環境変数を追加
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass


アプリケーションキーの作成
php artisan key:generate

マイグレーションの実行
php artisan migrate

シーディングの実行
php artisan db:seed
php artisan db:seed --class=ProductSeeder
