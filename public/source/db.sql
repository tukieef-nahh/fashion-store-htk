-- Tạo bảng danh_mucs
CREATE TABLE danh_mucs (
    id UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tenDM VARCHAR(255) NOT NULL,
    moTa TEXT NOT NULL,
    slug VARCHAR(255),
    status INT DEFAULT 1, -- 1: active, 0: inactive
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
);

-- Tạo bảng thuong_hieus
CREATE TABLE thuong_hieus (
    id UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tenTH VARCHAR(255) NOT NULL,
    moTa TEXT NOT NULL,
    slug VARCHAR(255),
    status INT DEFAULT 1,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
);

-- Tạo bảng san_phams
CREATE TABLE san_phams (
    id UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tenSP VARCHAR(255) NOT NULL DEFAULT '',
    slug VARCHAR(255),
    moTa TEXT NOT NULL DEFAULT '',
    gia DECIMAL(8, 2) NOT NULL,
    soLuong INT DEFAULT 0,
    danh_muc_id UNSIGNED NOT NULL,
    thuong_hieu_id UNSIGNED NOT NULL,
    image VARCHAR(255),
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    FOREIGN KEY (danh_muc_id) REFERENCES danh_mucs(id) ON DELETE CASCADE,
    FOREIGN KEY (thuong_hieu_id) REFERENCES thuong_hieus(id) ON DELETE CASCADE
);

-- Thêm dữ liệu vào bảng danh_mucs
INSERT INTO danh_mucs (tenDM, moTa, slug, status, created_at, updated_at) VALUES
('Quần áo nam', 'Các loại quần áo dành cho nam giới', 'quan-ao-nam', 1, NOW(), NOW()),
('Quần áo nữ', 'Các loại quần áo dành cho nữ giới', 'quan-ao-nu', 1, NOW(), NOW()),
('Phụ kiện', 'Phụ kiện thời trang', 'phu-kien', 1, NOW(), NOW());

-- Thêm dữ liệu vào bảng thuong_hieus
INSERT INTO thuong_hieus (tenTH, moTa, slug, status, created_at, updated_at) VALUES
('Adidas', 'Thương hiệu Adidas', 'adidas', 1, NOW(), NOW()),
('Nike', 'Thương hiệu Nike', 'nike', 1, NOW(), NOW()),
('Puma', 'Thương hiệu Puma', 'puma', 1, NOW(), NOW());

-- Thêm dữ liệu vào bảng san_phams
INSERT INTO san_phams (tenSP, slug, moTa, gia, soLuong, danh_muc_id, thuong_hieu_id, image, created_at, updated_at) VALUES
('Áo thun nam', 'ao-thun-nam', 'Áo thun nam chất liệu cotton', 200000, 50, 1, 1, 'ao-thun-nam.jpg', NOW(), NOW()),
('Quần jeans nữ', 'quan-jeans-nu', 'Quần jeans nữ phong cách Hàn Quốc', 400000, 30, 2, 2, 'quan-jeans-nu.jpg', NOW(), NOW()),
('Giày thể thao Adidas', 'giay-the-thao-adidas', 'Giày thể thao Adidas chính hãng', 1200000, 20, 1, 1, 'giay-the-thao-adidas.jpg', NOW(), NOW()),
('Balo Nike', 'balo-nike', 'Balo thời trang Nike', 500000, 15, 3, 2, 'balo-nike.jpg', NOW(), NOW());
