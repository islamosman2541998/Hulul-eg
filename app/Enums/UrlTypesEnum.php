<?php

namespace App\Enums;

class UrlTypesEnum
{


    public const PAGES = 'pages';
    public const ABOUTUS = 'about-us';
    public const CATEGORIES = 'categories';
    public const ALLCATEGORIE = 'all-categories';
    public const PRODUCTS = 'products';
    public const ALLPRODUCT = 'allproducts';
    public const BLOGS = 'blogs';
    public const ALLBLOG = 'all-blogs';
    public const NEWS = 'news';
    public const ALLNEW = 'all-news';
    public const JOBS = 'jobs';
    public const ALLJOB = 'all-jobs';
    public const QUESTIONS = 'faq-questions';
    public const CONTACTUS = 'contact-us';


    public static function values(): array
    {

        return [
            static::PAGES => 'pages',
            static::ABOUTUS => 'about-us',
            static::CONTACTUS => 'contact-us',
            static::ALLCATEGORIE => 'all-categories',
            static::CATEGORIES => 'categories',
            static::ALLPRODUCT => 'all-products',
            static::PRODUCTS => 'products',
            static::ALLBLOG => 'all-blogs',
            static::BLOGS => 'blogs',
            static::ALLNEW => 'all-news',
            static::NEWS => 'news',
            static::ALLJOB => 'all-jobs',
            static::JOBS => 'jobs',
            static::QUESTIONS => 'faq-questions',
            
            

        ];
    }
}
