
   INFO  Preparing database.  

  Creating migration table ........................................................................................... 19ms DONE

   INFO  Running migrations.  

  2014_10_12_000000_create_users_table .........................................................................................  
  ⇂ create table `users` (`id` bigint unsigned not null auto_increment primary key, `name` varchar(255) not null, `email` varchar(255) not null, `email_verified_at` timestamp null, `password` varchar(255) not null, `role` varchar(255) null, `remember_token` varchar(100) null, `current_team_id` bigint unsigned null, `profile_photo_path` varchar(2048) null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'  
  ⇂ alter table `users` add unique `users_email_unique`(`email`)  
  2014_10_12_100000_create_password_resets_table ...............................................................................  
  ⇂ create table `password_resets` (`email` varchar(255) not null, `token` varchar(255) not null, `created_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'  
  ⇂ alter table `password_resets` add index `password_resets_email_index`(`email`)  
  2014_10_12_200000_add_two_factor_columns_to_users_table ......................................................................  
  ⇂ alter table `users` add `two_factor_secret` text null after `password`, add `two_factor_recovery_codes` text null after `two_factor_secret`, add `two_factor_confirmed_at` timestamp null after `two_factor_recovery_codes`  
  2019_08_19_000000_create_failed_jobs_table ...................................................................................  
  ⇂ create table `failed_jobs` (`id` bigint unsigned not null auto_increment primary key, `uuid` varchar(255) not null, `connection` text not null, `queue` text not null, `payload` longtext not null, `exception` longtext not null, `failed_at` timestamp default CURRENT_TIMESTAMP not null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'  
  ⇂ alter table `failed_jobs` add unique `failed_jobs_uuid_unique`(`uuid`)  
  2019_12_14_000001_create_personal_access_tokens_table ........................................................................  
  ⇂ create table `personal_access_tokens` (`id` bigint unsigned not null auto_increment primary key, `tokenable_type` varchar(255) not null, `tokenable_id` bigint unsigned not null, `name` varchar(255) not null, `token` varchar(64) not null, `abilities` text null, `last_used_at` timestamp null, `expires_at` timestamp null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'  
  ⇂ alter table `personal_access_tokens` add index `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type`, `tokenable_id`)  
  ⇂ alter table `personal_access_tokens` add unique `personal_access_tokens_token_unique`(`token`)  
  2022_09_22_031839_create_sessions_table ......................................................................................  
  ⇂ create table `sessions` (`id` varchar(255) not null, `user_id` bigint unsigned null, `ip_address` varchar(45) null, `user_agent` text null, `payload` longtext not null, `last_activity` int not null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'  
  ⇂ alter table `sessions` add primary key `sessions_id_primary`(`id`)  
  ⇂ alter table `sessions` add index `sessions_user_id_index`(`user_id`)  
  ⇂ alter table `sessions` add index `sessions_last_activity_index`(`last_activity`)  
  2022_09_22_055904_create_customers_table .....................................................................................  
  ⇂ create table `customers` (`id` bigint unsigned not null auto_increment primary key, `dpi` varchar(255) not null, `name` varchar(255) not null, `last_name` varchar(255) not null, `personal_phone` varchar(255) not null, `home_phone` varchar(255) not null, `employment_phone` varchar(255) not null, `company_name` varchar(255) not null, `employment_address` varchar(255) not null, `home_address` varchar(255) not null, `email` varchar(255) not null, `facebook` varchar(255) not null, `photo` varchar(255) not null, `name_reference` varchar(255) not null, `last_name_reference` varchar(255) not null, `phone_reference` varchar(255) not null, `email_reference` varchar(255) not null, `name_second_reference` varchar(255) null, `lastname_second_reference` varchar(255) null, `email_second_reference` varchar(255) null, `phone_second_reference` varchar(255) null, `name_third_reference` varchar(255) null, `last_name_third_reference` varchar(255) null, `email_third_reference` varchar(255) null, `phone_third_reference` varchar(255) null, `house_photo` varchar(255) null, `married` tinyint not null, `rent` tinyint not null, `id_user` bigint unsigned null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'  
  ⇂ alter table `customers` add constraint `customers_id_user_foreign` foreign key (`id_user`) references `users` (`id`) on delete set null on update cascade  
  2022_10_04_070521_create_credits_table .......................................................................................  
  ⇂ create table `credits` (`id` bigint unsigned not null auto_increment primary key, `capital` double(8, 2) not null, `interest_type` varchar(255) not null, `interest_rate` double(8, 2) not null, `payment_frequency` varchar(255) not null, `car_image` varchar(255) not null, `fee` double(8, 2) not null, `name_customer` varchar(255) not null, `dpi_customer` varchar(255) not null, `status` varchar(255) not null, `id_customer` bigint unsigned null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'  
  ⇂ alter table `credits` add constraint `credits_id_customer_foreign` foreign key (`id_customer`) references `customers` (`id`) on delete set null on update cascade  
  2022_10_04_070533_create_payments_table ......................................................................................  
  ⇂ create table `payments` (`id` bigint unsigned not null auto_increment primary key, `payment_number` varchar(255) not null, `payment_date` date not null, `interest` double(8, 2) not null, `fee` double(8, 2) not null, `capital` double(8, 2) not null, `balance` double(8, 2) not null, `status` varchar(255) not null, `financial_default` double(8, 2) null default '0', `financial_default_method` varchar(255) null, `certification_financial_default` varchar(255) null, `payment_day` date null, `certification_payment` varchar(255) null, `method_payment` varchar(255) null, `received_by` varchar(255) null, `id_credit` bigint unsigned null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'  
  ⇂ alter table `payments` add constraint `payments_id_credit_foreign` foreign key (`id_credit`) references `credits` (`id`) on delete set null on update cascade  
  2022_10_15_063256_add_conyuge ................................................................................................  
  ⇂ create table `conyuges` (`id` bigint unsigned not null auto_increment primary key, `dpi` varchar(255) null, `name` varchar(255) null, `last_name` varchar(255) null, `id_customer` bigint unsigned null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'  
  ⇂ alter table `conyuges` add constraint `conyuges_id_customer_foreign` foreign key (`id_customer`) references `customers` (`id`) on delete set null on update cascade  

