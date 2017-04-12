##说明

###
php artisan vendor:publish --tag=pinche

在config/app.php 中添加
ZCJY\Pinche\PincheServiceProvider::class

执行php artisan migrate

在public目录下新建uploads/images文件夹，并授予权限chmod -R 777 uploads
