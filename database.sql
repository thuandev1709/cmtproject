-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 18, 2018 lúc 10:49 AM
-- Phiên bản máy phục vụ: 10.1.34-MariaDB
-- Phiên bản PHP: 5.6.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `leme`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lm01_users`
--

CREATE TABLE `lm01_users` (
  `lm01_user_id` int(11) NOT NULL,
  `lm01_email` varchar(80) DEFAULT NULL,
  `lm01_password` varchar(225) DEFAULT NULL,
  `lm01_firstname` varchar(80) DEFAULT NULL,
  `lm01_lastname` varchar(80) NOT NULL,
  `lm01_company_name` varchar(225) NOT NULL,
  `lm01_phonetic_name_1` varchar(80) NOT NULL,
  `lm01_phonetic_name_2` varchar(80) NOT NULL,
  `lm01_zipcode` varchar(10) NOT NULL,
  `lm01_street` varchar(225) NOT NULL,
  `lm01_county` varchar(10) NOT NULL,
  `lm01_city` varchar(225) NOT NULL,
  `lm01_phone_number_1` varchar(20) NOT NULL,
  `lm01_phone_number_2` varchar(20) NOT NULL,
  `lm01_phone_number_3` varchar(20) NOT NULL,
  `lm01_fax_number_1` varchar(20) NOT NULL,
  `lm01_fax_number_2` varchar(20) NOT NULL,
  `lm01_fax_number_3` varchar(20) NOT NULL,
  `lm01_birthday` int(20) NOT NULL,
  `lm01_sex` int(11) NOT NULL COMMENT '1 = boy / 0 = girl',
  `lm01_job` varchar(80) NOT NULL,
  `lm01_active_status` int(1) DEFAULT NULL COMMENT '1 = active / 0 = delete',
  `lm01_created_at` varchar(14) DEFAULT NULL,
  `lm01_updated_at` varchar(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lm02_contact`
--

CREATE TABLE `lm02_contact` (
  `lm02_email_id` int(11) NOT NULL,
  `lm02_email_sender` varchar(80) DEFAULT NULL,
  `lm02_firstname_sender` varchar(80) DEFAULT NULL,
  `lm02_lastname_sender` varchar(80) NOT NULL,
  `lm02_zipcode` varchar(10) DEFAULT NULL,
  `lm02_street` varchar(225) NOT NULL,
  `lm02_county` varchar(20) NOT NULL,
  `lm02_city` varchar(225) NOT NULL,
  `lm02_phone_number` varchar(20) DEFAULT NULL,
  `lm02_question_type` varchar(20) DEFAULT NULL,
  `lm02_content_email` text,
  `lm02_created_at` varchar(14) DEFAULT NULL,
  `lm02_updated_at` varchar(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lm03_category`
--

CREATE TABLE `lm03_category` (
  `lm03_cate_id` int(11) NOT NULL,
  `lm03_event_id` int(11) NOT NULL,
  `lm03_cate_name` varchar(225) NOT NULL,
  `lm03_active_status` int(1) NOT NULL DEFAULT '1',
  `lm03_display` varchar(1) DEFAULT NULL,
  `lm03_sort` varchar(8) DEFAULT NULL,
  `lm03_created_at` varchar(14) DEFAULT NULL,
  `lm03_updated_at` varchar(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `lm03_category`
--

INSERT INTO `lm03_category` (`lm03_cate_id`, `lm03_event_id`, `lm03_cate_name`, `lm03_active_status`, `lm03_display`, `lm03_sort`, `lm03_created_at`, `lm03_updated_at`) VALUES
(1, 1, 'Category 1', 1, '1', NULL, '201810300000', '201810300000'),
(2, 1, 'Category 2', 1, '1', NULL, '201810300000', '201810300000'),
(3, 1, 'Category 3', 1, '1', NULL, '201810300000', '201810300000'),
(4, 1, 'Category 4', 1, '1', NULL, '201810300000', '201810300000'),
(5, 2, 'Category 5', 1, '1', NULL, '201810300000', '201810300000'),
(6, 2, 'Category 6', 1, '1', NULL, '201810300000', '201810300000'),
(7, 2, 'Category 7', 1, '1', NULL, '201810300000', '201810300000'),
(8, 2, 'Category 8', 1, '1', NULL, '201810300000', '201810300000');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lm04_product`
--

CREATE TABLE `lm04_product` (
  `lm04_pro_id` int(11) NOT NULL,
  `lm04_cate_id` int(11) NOT NULL,
  `lm04_event_id` int(11) NOT NULL,
  `lm04_pro_type` int(11) NOT NULL COMMENT '0 = 写真 / 1 = 動画',
  `lm04_pro_name` varchar(225) NULL,
  `lm04_pro_content` text,
  `lm04_pro_keyword` varchar(225) DEFAULT NULL,
  `lm04_pro_price` decimal(9,0) NOT NULL,
  `lm04_pro_discount` varchar(225) DEFAULT NULL,
  `lm04_pro_quantity` int(11) NOT NULL,
  `lm04_active_status` int(1) NOT NULL DEFAULT '1' COMMENT '1 = active / 0 = delete',
  `lm04_display` varchar(1) DEFAULT NULL,
  `lm04_sort` varchar(8) DEFAULT NULL,
  `lm04_datetime_final_sales` varchar(14) DEFAULT NULL,
  `lm04_created_at` varchar(14) DEFAULT NULL,
  `lm04_updated_at` varchar(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lm05_image`
--

CREATE TABLE `lm05_image` (
  `lm05_image_id` int(11) NOT NULL,
  `lm05_pro_id` int(11) NOT NULL,
  `lm05_image_name` varchar(225) DEFAULT NULL,
  `lm05_image_rename` varchar(225) DEFAULT NULL,
  `lm05_image_path` text,
  `lm05_image_ext` varchar(4) DEFAULT NULL,
  `lm05_created_at` varchar(14) DEFAULT NULL,
  `lm05_updated_at` varchar(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lm06_movie`
--

CREATE TABLE `lm06_movie` (
  `lm06_movie_id` int(11) NOT NULL,
  `lm06_pro_id` int(11) NOT NULL,
  `lm06_movie_name` varchar(225) DEFAULT NULL,
  `lm06_movie_rename` varchar(225) DEFAULT NULL,
  `lm06_movie_path` text,
  `lm06_movie_ext` varchar(4) DEFAULT NULL,
  `lm06_created_at` varchar(14) DEFAULT NULL,
  `lm06_updated_at` varchar(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lm07_order`
--

CREATE TABLE `lm07_order` (
  `lm07_order_id` int(11) NOT NULL,
  `lm07_user_id` int(11) NOT NULL,
  `lm07_total_quantity` int(11) NOT NULL,
  `lm07_total_price` decimal(9,0) NOT NULL,
  `lm07_tax` decimal(9,0) DEFAULT NULL,
  `lm07_usb_money` decimal(9,0) DEFAULT NULL,
  `lm07_fee_transport` decimal(9,0) DEFAULT NULL,
  `lm07_date_order` varchar(14) DEFAULT NULL,
  `lm07_delivery_address_new` int(1) DEFAULT NULL COMMENT '1 = Yes (lm_17) / 0 = No',
  `lm07_active_status` int(1) NOT NULL DEFAULT '1' COMMENT '1 = active / 0 = delete',
  `lm07_pay_status` int(1) NOT NULL DEFAULT '0',
  `lm07_method_id` int(11) NOT NULL,
  `lm07_date_delivery` varchar(14) DEFAULT NULL,
  `lm07_created_at` varchar(14) DEFAULT NULL,
  `lm07_updated_at` varchar(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lm08_order_details`
--

CREATE TABLE `lm08_order_details` (
  `lm08_order_details_id` int(11) NOT NULL,
  `lm08_order_id` int(11) NOT NULL,
  `lm08_pro_id` int(11) NOT NULL,
  `lm08_pro_number` int(11) NOT NULL,
  `lm08_quantity` int(11) NOT NULL,
  `lm08_price` decimal(9,0) NOT NULL,
  `lm08_tax` decimal(3,0) NOT NULL,
  `lm08_discount` varchar(225) DEFAULT NULL,
  `lm08_total_price` decimal(9,0) NOT NULL,
  `lm08_created_at` varchar(14) DEFAULT NULL,
  `lm08_updated_at` varchar(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lm09_admin`
--

CREATE TABLE `lm09_admin` (
  `lm09_admin_id` int(11) NOT NULL,
  `lm09_username` varchar(80) NOT NULL,
  `lm09_email` varchar(225) NOT NULL,
  `lm09_password` varchar(225) NOT NULL,
  `lm09_fullname` varchar(225) DEFAULT NULL,
  `lm09_active_status` int(1) NOT NULL COMMENT '1 = active / 0 = delete',
  `lm09_created_at` varchar(14) DEFAULT NULL,
  `lm09_updated_at` varchar(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `lm09_admin`
--

INSERT INTO `lm09_admin` (`lm09_admin_id`, `lm09_username`, `lm09_email`, `lm09_password`, `lm09_fullname`, `lm09_active_status`, `lm09_created_at`, `lm09_updated_at`) VALUES
(1, 'admin', 'admin@leme.shop', '14e1b600b1fd579f47433b88e8d85291', 'Administrator', 1, '20181011160909', '20181011160909');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lm10_event`
--

CREATE TABLE `lm10_event` (
  `lm10_event_id` int(11) NOT NULL,
  `lm10_event_id_input` varchar(6) NOT NULL,
  `lm10_event_name` varchar(225) NOT NULL,
  `lm10_event_password` varchar(225) NOT NULL,
  `lm10_date_start` varchar(14) NOT NULL,
  `lm10_date_predetermine` varchar(14) NOT NULL,
  `lm10_date_end` varchar(14) NOT NULL,
  `lm10_display` varchar(1) NOT NULL,
  `lm10_created_at` varchar(14) DEFAULT NULL,
  `lm10_updated_at` varchar(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `lm10_event`
--

INSERT INTO `lm10_event` (`lm10_event_id`, `lm10_event_id_input`, `lm10_event_name`, `lm10_event_password`, `lm10_date_start`, `lm10_date_predetermine`, `lm10_date_end`, `lm10_display`, `lm10_created_at`, `lm10_updated_at`) VALUES
(1, 'A00001', 'Event A1', '14e1b600b1fd579f47433b88e8d85291', '20181007', '20181007', '20181030', '1', '201810070000', '20181011161303'),
(2, 'A00002', 'Event A2', '14e1b600b1fd579f47433b88e8d85291', '20181007', '20181007', '20181103', '1', '201810070000', '20181011161303'),
(3, 'A00003', 'Event A3', '14e1b600b1fd579f47433b88e8d85291', '20181007', '20181007', '20181104', '1', '201810070000', '20181011161303'),
(4, 'A00004', 'Event A4', '14e1b600b1fd579f47433b88e8d85291', '20181007', '20181007', '20181105', '1', '201810070000', '20181011161303'),
(5, 'B00001', 'Event B1', '14e1b600b1fd579f47433b88e8d85291', '20181012', '20181007', '20181106', '1', '201810070000', '20181011161303'),
(6, 'B00002', 'Event B2', '14e1b600b1fd579f47433b88e8d85291', '20181013', '20181007', '20181107', '1', '201810070000', '20181011161303'),
(7, 'B00003', 'Event B3', '14e1b600b1fd579f47433b88e8d85291', '20181014', '20181007', '20181213', '1', '201810070000', '20181011161303'),
(8, 'B00004', 'Event B4', '14e1b600b1fd579f47433b88e8d85291', '20181015', '20181007', '20181215', '1', '201810070000', '20181011161303'),
(9, 'C00001', 'Event C1', '14e1b600b1fd579f47433b88e8d85291', '20181018', '20181007', '20181216', '1', '201810070000', '20181011161303'),
(10, 'C00002', 'Event C2', '14e1b600b1fd579f47433b88e8d85291', '20181018', '20181007', '20181217', '1', '201810070000', '20181011161303'),
(11, 'C00003', 'Event C3', '14e1b600b1fd579f47433b88e8d85291', '20181020', '20181007', '20181219', '1', '201810070000', '20181011161303');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lm11_default_value`
--

CREATE TABLE `lm11_default_value` (
  `lm11_id` int(11) NOT NULL,
  `lm11_value_name` varchar(225) NOT NULL,
  `lm11_value_default` varchar(225) NOT NULL,
  `lm11_created_at` varchar(14) DEFAULT NULL,
  `lm11_updated_at` varchar(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `lm11_default_value`
--

INSERT INTO `lm11_default_value` (`lm11_id`, `lm11_value_name`, `lm11_value_default`, `lm11_created_at`, `lm11_updated_at`) VALUES
(1, '画像の値段＊', '120', '20181008091400', '20181008091400'),
(2, 'DVDの値段＊', '150', '20181008091400', '20181008091400'),
(3, '運送料金', '200', '20181008091400', '20181008091400'),
(4, '掲載期限', '30', '20181008091400', '20181008091400'),
(5, '最初のDVD枚数', '100', '20181008091400', '20181008091400'),
(6, '警告DVD枚数', '5', '20181008091400', '20181008091400');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lm12_info_company`
--

CREATE TABLE `lm12_info_company` (
  `lm12_id` int(11) NOT NULL,
  `lm12_name` varchar(225) NOT NULL,
  `lm12_address` text NOT NULL,
  `lm12_phone` varchar(20) NOT NULL,
  `lm12_info_customer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `lm12_info_company`
--

INSERT INTO `lm12_info_company` (`lm12_id`, `lm12_name`, `lm12_address`, `lm12_phone`, `lm12_info_customer`) VALUES
(1, 'Belleza', '92 Nguyen Huu Canh', '0978228172', '92 Nguyen Huu Canh');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lm13_pay_method`
--

CREATE TABLE `lm13_pay_method` (
  `lm13_method_id` int(11) NOT NULL,
  `lm13_method_name` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `lm13_pay_method`
--

INSERT INTO `lm13_pay_method` (`lm13_method_id`, `lm13_method_name`) VALUES
(1, 'カード'),
(2, '振り込み');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lm14_tax_setting`
--

CREATE TABLE `lm14_tax_setting` (
  `lm14_tax_id` int(11) NOT NULL,
  `lm14_date_start` varchar(14) NOT NULL,
  `lm14_date_end` varchar(14) NOT NULL,
  `lm14_percent` varchar(3) NOT NULL,
  `lm14_created_at` varchar(14) DEFAULT NULL,
  `lm14_updated_at` varchar(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `lm14_tax_setting`
--

INSERT INTO `lm14_tax_setting` (`lm14_tax_id`, `lm14_date_start`, `lm14_date_end`, `lm14_percent`, `lm14_created_at`, `lm14_updated_at`) VALUES
(1, '20181011112137', '20181018000000', '12', '20181011112131', '20181011112137');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lm15_email_send_mail`
--

CREATE TABLE `lm15_email_send_mail` (
  `lm15_id` int(11) NOT NULL,
  `lm15_event_id` int(11) NOT NULL,
  `lm15_email` varchar(225) NOT NULL,
  `lm15_type` varchar(1) NOT NULL COMMENT '1 = 本人 / 2 = 関係者/ 0 = 無関係',
  `lm15_created_at` varchar(14) NOT NULL,
  `lm15_updated_at` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lm16_news`
--

CREATE TABLE `lm16_news` (
  `lm16_news_id` int(11) NOT NULL,
  `lm16_news_title` varchar(225) NOT NULL,
  `lm16_news_content` text NOT NULL,
  `lm16_news_status` int(1) NOT NULL COMMENT '1 = active / 0 = inactive',
  `lm16_news_date` varchar(20) NOT NULL,
  `lm16_news_created_at` varchar(20) NOT NULL,
  `lm16_news_updated_at` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lm17_delivery_address_new`
--

CREATE TABLE IF NOT EXISTS `lm17_delivery_address_new` (
  `lm17_id` int(11) NOT NULL,
  `lm17_order_id` int(11) NOT NULL,
  `lm17_receiver_name` varchar(80) NOT NULL,
  `lm17_zipcode` varchar(10) NOT NULL,
  `lm17_address` text NOT NULL,
  `lm17_phone` varchar(20) DEFAULT NULL,
  `lm17_created_at` varchar(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `lm01_users`
--
ALTER TABLE `lm01_users`
  ADD PRIMARY KEY (`lm01_user_id`);

--
-- Chỉ mục cho bảng `lm02_contact`
--
ALTER TABLE `lm02_contact`
  ADD PRIMARY KEY (`lm02_email_id`);

--
-- Chỉ mục cho bảng `lm03_category`
--
ALTER TABLE `lm03_category`
  ADD PRIMARY KEY (`lm03_cate_id`);

--
-- Chỉ mục cho bảng `lm04_product`
--
ALTER TABLE `lm04_product`
  ADD PRIMARY KEY (`lm04_pro_id`);

--
-- Chỉ mục cho bảng `lm05_image`
--
ALTER TABLE `lm05_image`
  ADD PRIMARY KEY (`lm05_image_id`);

--
-- Chỉ mục cho bảng `lm06_movie`
--
ALTER TABLE `lm06_movie`
  ADD PRIMARY KEY (`lm06_movie_id`);

--
-- Chỉ mục cho bảng `lm07_order`
--
ALTER TABLE `lm07_order`
  ADD PRIMARY KEY (`lm07_order_id`);

--
-- Chỉ mục cho bảng `lm08_order_details`
--
ALTER TABLE `lm08_order_details`
  ADD PRIMARY KEY (`lm08_order_details_id`);

--
-- Chỉ mục cho bảng `lm09_admin`
--
ALTER TABLE `lm09_admin`
  ADD PRIMARY KEY (`lm09_admin_id`);

--
-- Chỉ mục cho bảng `lm10_event`
--
ALTER TABLE `lm10_event`
  ADD PRIMARY KEY (`lm10_event_id`);

--
-- Chỉ mục cho bảng `lm11_default_value`
--
ALTER TABLE `lm11_default_value`
  ADD PRIMARY KEY (`lm11_id`);

--
-- Chỉ mục cho bảng `lm12_info_company`
--
ALTER TABLE `lm12_info_company`
  ADD PRIMARY KEY (`lm12_id`);

--
-- Chỉ mục cho bảng `lm13_pay_method`
--
ALTER TABLE `lm13_pay_method`
  ADD PRIMARY KEY (`lm13_method_id`);

--
-- Chỉ mục cho bảng `lm14_tax_setting`
--
ALTER TABLE `lm14_tax_setting`
  ADD PRIMARY KEY (`lm14_tax_id`);

--
-- Chỉ mục cho bảng `lm15_email_send_mail`
--
ALTER TABLE `lm15_email_send_mail`
  ADD PRIMARY KEY (`lm15_id`);

--
-- Chỉ mục cho bảng `lm16_news`
--
ALTER TABLE `lm16_news`
  ADD PRIMARY KEY (`lm16_news_id`);

--
-- Chỉ mục cho bảng `lm17_delivery_address_new`
--
ALTER TABLE `lm17_delivery_address_new`
  ADD PRIMARY KEY (`lm17_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `lm01_users`
--
ALTER TABLE `lm01_users`
  MODIFY `lm01_user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `lm02_contact`
--
ALTER TABLE `lm02_contact`
  MODIFY `lm02_email_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `lm03_category`
--
ALTER TABLE `lm03_category`
  MODIFY `lm03_cate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `lm04_product`
--
ALTER TABLE `lm04_product`
  MODIFY `lm04_pro_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `lm05_image`
--
ALTER TABLE `lm05_image`
  MODIFY `lm05_image_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `lm06_movie`
--
ALTER TABLE `lm06_movie`
  MODIFY `lm06_movie_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `lm07_order`
--
ALTER TABLE `lm07_order`
  MODIFY `lm07_order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `lm08_order_details`
--
ALTER TABLE `lm08_order_details`
  MODIFY `lm08_order_details_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `lm09_admin`
--
ALTER TABLE `lm09_admin`
  MODIFY `lm09_admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `lm10_event`
--
ALTER TABLE `lm10_event`
  MODIFY `lm10_event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `lm11_default_value`
--
ALTER TABLE `lm11_default_value`
  MODIFY `lm11_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `lm12_info_company`
--
ALTER TABLE `lm12_info_company`
  MODIFY `lm12_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `lm13_pay_method`
--
ALTER TABLE `lm13_pay_method`
  MODIFY `lm13_method_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `lm14_tax_setting`
--
ALTER TABLE `lm14_tax_setting`
  MODIFY `lm14_tax_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `lm15_email_send_mail`
--
ALTER TABLE `lm15_email_send_mail`
  MODIFY `lm15_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `lm16_news`
--
ALTER TABLE `lm16_news`
  MODIFY `lm16_news_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `lm17_delivery_address_new`
--
ALTER TABLE `lm17_delivery_address_new`
  MODIFY `lm17_id` int(11) NOT NULL AUTO_INCREMENT;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
