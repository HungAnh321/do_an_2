<?php

namespace App\Providers;

use App\Repositories\Blogs\BlogsRepository;
use App\Repositories\Blogs\BlogsRepositoryInterface;
use App\Repositories\Brand\BrandRepository;
use App\Repositories\Brand\BrandRepositoryInterface;
use App\Repositories\Order\OrderReponsitory;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\OrderDetail\OrderDetailRepository;
use App\Repositories\OrderDetail\OrderDetailRepositoryInterface;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\ProductCategory\ProductCategoryRepository;
use App\Repositories\ProductCategory\ProductCategoryRepositoryInterface;
use App\Repositories\ProductComment\ProductCommentRepository;
use App\Repositories\ProductComment\ProductCommentRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Sevice\Blogs\BlogsSevice;
use App\Sevice\Blogs\BlogsSeviceInterface;
use App\Sevice\Brand\BrandSevice;
use App\Sevice\Brand\BrandSeviceInterface;
use App\Sevice\Order\OrderSevice;
use App\Sevice\Order\OrderSeviceInterface;
use App\Sevice\OrderDetail\OrderDetailSevice;
use App\Sevice\OrderDetail\OrderDetailSeviceInterface;
use App\Sevice\Product\ProductSevice;
use App\Sevice\Product\ProductSeviceInterface;
use App\Sevice\ProductCategory\ProductCategorySevice;
use App\Sevice\ProductCategory\ProductCategorySeviceInterface;
use App\Sevice\ProductComment\ProductCommentSevice;
use App\Sevice\ProductComment\ProductCommentSeviceInterface;
use App\Sevice\User\UserSevice;
use App\Sevice\User\UserSeviceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );
        $this->app->singleton(
            ProductSeviceInterface::class,
            ProductSevice::class
        );
        $this->app->singleton(
            ProductCommentRepositoryInterface::class,
            ProductCommentRepository::class
        );
        $this->app->singleton(
            ProductCommentSeviceInterface::class,
            ProductCommentSevice::class
        );
        $this->app->singleton(
            BlogsRepositoryInterface::class,
            BlogsRepository::class
        );
        $this->app->singleton(
            BlogsSeviceInterface::class,
            BlogsSevice::class
        );
        $this->app->singleton(
            ProductCategoryRepositoryInterface::class,
            ProductCategoryRepository::class
        );
        $this->app->singleton(
            ProductCategorySeviceInterface::class,
            ProductCategorySevice::class
        );
        $this->app->singleton(
            BrandRepositoryInterface::class,
            BrandRepository::class
        );
        $this->app->singleton(
            BrandSeviceInterface::class,
            BrandSevice::class
        );
        $this->app->singleton(
            OrderRepositoryInterface::class,
            OrderReponsitory::class
        );
        $this->app->singleton(
            OrderSeviceInterface::class,
            OrderSevice::class
        );
        $this->app->singleton(
            OrderDetailRepositoryInterface::class,
            OrderDetailRepository::class
        );
        $this->app->singleton(
            OrderDetailSeviceInterface::class,
            OrderDetailSevice::class
        );
        $this->app->singleton(
            UserRepositoryInterface::class,
            UserRepository::class
        );
        $this->app->singleton(
            UserSeviceInterface::class,
            UserSevice::class
        );

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
