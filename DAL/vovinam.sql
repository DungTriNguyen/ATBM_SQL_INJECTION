
-- Bảng quyền
CREATE TABLE quyen (
    maQuyen VARCHAR(255) PRIMARY KEY NOT NULL,
    tenQuyen VARCHAR(255)
);
-- Bảng tài khoản
CREATE TABLE taikhoan (
    tenDangNhap VARCHAR(255) PRIMARY KEY NOT NULL,
    ho VARCHAR(255),
    ten VARCHAR(255),
    matKhau VARCHAR(255),
    anhDaiDien VARCHAR(255),
    loai ENUM('SUPPER_ADMIN', 'JUDGE', 'CLUB_COACH', 'STUDENT'),
    thoiGianTao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    thoiGianSua TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    kichHoat INT(1) DEFAULT 1, -- 1: hiển thị, 0: khóa
    soDienThoai VARCHAR(255),
    maQuyen VARCHAR(255),
    FOREIGN KEY (maQuyen) REFERENCES quyen(maQuyen)
);

-- Bảng chức năng
CREATE TABLE chucnang (
    maChucNang VARCHAR(255) PRIMARY KEY NOT NULL,
    tenChucNang VARCHAR(255)
);

-- Bảng chi tiết quyền
CREATE TABLE chitietquyen (
    maQuyen VARCHAR(255) NOT NULL,
    maChucNang VARCHAR(255) NOT NULL,
    chucNangThem INT(1) DEFAULT 0,
    chucNangSua INT(1) DEFAULT 0,
    chucNangXoa INT(1) DEFAULT 0,
    chucNangTimKiem INT(1) DEFAULT 0,
    chamDiemDonLuyen INT(1) DEFAULT 0,
    chamDiemSongLuyen INT(1) DEFAULT 0,
    chamDiemCanBan INT(1) DEFAULT 0,
    chamDiemDoiKhang INT(1) DEFAULT 0,
    chamDiemTheLuc INT(1) DEFAULT 0,
    chamDiemLyThuyet INT(1) DEFAULT 0,
    PRIMARY KEY (maQuyen, maChucNang),
    FOREIGN KEY (maQuyen) REFERENCES quyen(maQuyen),
    FOREIGN KEY (maChucNang) REFERENCES chucnang(maChucNang)
);


-- Bảng khóa thi
CREATE TABLE khoathi (
    maKhoaThi INT PRIMARY KEY AUTO_INCREMENT,
    tenKhoaThi VARCHAR(255),
    ngayThi DATE,
    hienThi INT(1) DEFAULT 1, -- 0: ẩn, 1: hiển thị
    ghiChu VARCHAR(255)
);

-- Bảng cấp đai
CREATE TABLE capdai (
    maCapDai INT PRIMARY KEY AUTO_INCREMENT,
    tenCapDai VARCHAR(255)
);

-- Bảng kỹ thuật
CREATE TABLE kythuat (
    maKyThuat INT PRIMARY KEY AUTO_INCREMENT,
    tenKyThuat VARCHAR(255)
);

-- Bảng môn sinh
CREATE TABLE monsinh (
    maMonSinh INT PRIMARY KEY AUTO_INCREMENT,
    maThe INT,
    hoTen VARCHAR(255),
    gioiTinh TINYINT(1) Default 1,
    ngaySinh DATE,
    chieuCao INT,
    canNang INT,
    diaChi VARCHAR(255),
    soDienThoai VARCHAR(255),
    email VARCHAR(255),
    cccd VARCHAR(255),
    anhCCCD VARCHAR(255),
    anh3x4 VARCHAR(255),
    ngayCapCCCD DATE,
    noiCapCCCD VARCHAR(255),
    tenPhuHuynh VARCHAR(255),
    sdtPhuHuynh VARCHAR(255),
    congViec VARCHAR(255),
    lichSuTapLuyen VARCHAR(255),
    lichSuThi VARCHAR(255),
    bangCap VARCHAR(255),
    trinhDoVanHoa VARCHAR(255),
    khaNangNoiBat VARCHAR(255),
    maCapDai INT, -- Cấp đai hiện tại
    FOREIGN KEY (maCapDai) REFERENCES capdai(maCapDai)

);

-- Bảng kết quả thi
CREATE TABLE ketquathi (
    maKetQuaThi INT PRIMARY KEY AUTO_INCREMENT,
    maMonSinh INT,
    maKhoaThi INT,
    capDaiHienTai INT,
    capDaiDuThi INT,
    ketQua INT(1) DEFAULT 0, -- 1: đậu, 0: rớt
    trangThaiHoSo INT(1) DEFAULT 0, -- 1: được duyệt, 0: chưa duyệt
    ghiChu VARCHAR(255),
    ngayCham DATE,
    FOREIGN KEY (maMonSinh) REFERENCES monsinh(maMonSinh),
    FOREIGN KEY (maKhoaThi) REFERENCES khoathi(maKhoaThi),
    FOREIGN KEY (capDaiHienTai) REFERENCES capdai(maCapDai),
    FOREIGN KEY (capDaiDuThi) REFERENCES capdai(maCapDai)
);

-- Bảng chi tiết kết quả thi
CREATE TABLE chitietketquathi (
    maChiTietKetQua INT PRIMARY KEY AUTO_INCREMENT,
    maKetQuaThi INT,
    maKyThuat INT, -- Nội dung thi như Kỹ thuật căn bản
    diemDon FLOAT,
    diemCan FLOAT,
    diemSong FLOAT,
    diemDoi FLOAT,
    diemLyThuyet FLOAT,
    diemTheLuc FLOAT,
    tongDiem FLOAT,
    ketQua INT(1) DEFAULT 0, -- 1: đạt, 0: không đạt
    ghiChu VARCHAR(255),
    tenDangNhap VARCHAR(255),
    FOREIGN KEY (maKetQuaThi) REFERENCES ketquathi(maKetQuaThi),
    FOREIGN KEY (tenDangNhap) REFERENCES taikhoan(tenDangNhap),
    FOREIGN KEY (maKyThuat) REFERENCES kythuat(maKyThuat)
);




-- Bảng chi tiết quyền liên kết với bảng quyền
ALTER TABLE chitietquyen
ADD FOREIGN KEY (maQuyen) REFERENCES quyen(maQuyen);

-- Bảng chi tiết quyền liên kết với bảng chức năng
ALTER TABLE chitietquyen
ADD FOREIGN KEY (maChucNang) REFERENCES chucnang(maChucNang);

-- Bảng kết quả thi liên kết với bảng môn sinh
ALTER TABLE ketquathi
ADD FOREIGN KEY (maMonSinh) REFERENCES monsinh(maMonSinh);

-- Bảng kết quả thi liên kết với bảng khóa thi
ALTER TABLE ketquathi
ADD FOREIGN KEY (maKhoaThi) REFERENCES khoathi(maKhoaThi);

-- Bảng chi tiết kết quả thi liên kết với bảng kết quả thi
ALTER TABLE chitietketquathi
ADD FOREIGN KEY (maKetQuaThi) REFERENCES ketquathi(maKetQuaThi);

-- Bảng chi tiết kết quả thi liên kết với bảng tài khoản (giám khảo chấm thi)
ALTER TABLE chitietketquathi
ADD FOREIGN KEY (tenDangNhap) REFERENCES taikhoan(tenDangNhap);


-- Thêm dữ liệu vào các bảng
-- Thêm dữ liệu vào bảng quyền
INSERT INTO quyen (maQuyen, tenQuyen) VALUES
('admin', 'Administrator'),
('judge', 'Judge'),
('coach', 'Coach'),
('student', 'Student');


-- Thêm dữ liệu vào bảng taikhoan
INSERT INTO taikhoan (tenDangNhap, ho, ten, matKhau, anhDaiDien, loai, thoiGianTao, thoiGianSua, kichHoat, soDienThoai, maQuyen) VALUES
('nguyenvana', 'Nguyen', 'Van A', 'password123', 'avatar.jpg', 'STUDENT', NOW(), NOW(), 1, '0912345678', 'student'),
('judgehong', 'Hoang', 'Hong', 'judgepass', 'judge.jpg', 'JUDGE', NOW(), NOW(), 1, '0923456789', 'judge');


-- Thêm dữ liệu vào bảng chức năng
INSERT INTO chucnang (maChucNang, tenChucNang) VALUES
('add', 'Add'),
('edit', 'Edit'),
('delete', 'Delete'),
('search', 'Search'),
('evaluate', 'Evaluate');

-- Thêm dữ liệu vào bảng chi tiết quyền
INSERT INTO chitietquyen (maQuyen, maChucNang, chucNangThem, chucNangSua, chucNangXoa, chucNangTimKiem, chamDiemDonLuyen, chamDiemSongLuyen, chamDiemCanBan, chamDiemDoiKhang, chamDiemTheLuc, chamDiemLyThuyet) VALUES
('admin', 'add', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
('admin', 'edit', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
('judge', 'evaluate', 0, 0, 0, 0, 1, 1, 1, 1, 1, 1);

-- Thêm dữ liệu vào bảng khóa thi
INSERT INTO khoathi (tenKhoaThi, ngayThi, hienThi, ghiChu) VALUES
('Kỳ Thi Hè 2024', '2024-08-01', 1, 'Thi đầu mùa hè'),
('Kỳ Thi Thu 2024', '2024-11-01', 1, 'Thi cuối mùa thu');

-- Thêm dữ liệu vào bảng cấp đai
INSERT INTO capdai (tenCapDai) VALUES
('Đai Xanh'),
('Đai Đen'),
('Đai Trắng');

-- Thêm dữ liệu vào bảng kỹ thuật
INSERT INTO kythuat (tenKyThuat) VALUES
('Kỹ thuật cơ bản'),
('Kỹ thuật nâng cao');

-- Thêm dữ liệu vào bảng môn sinh
INSERT INTO monsinh (
    maThe, hoTen, gioiTinh, ngaySinh, chieuCao, canNang, diaChi, soDienThoai, email, cccd,
    anhCCCD, anh3x4, ngayCapCCCD, noiCapCCCD, tenPhuHuynh, sdtPhuHuynh, congViec, lichSuTapLuyen,
    lichSuThi, bangCap, trinhDoVanHoa, khaNangNoiBat, maCapDai
) VALUES (
    1, 'Nguyen Van A', 1, '2000-01-01', 170, 60, '123 Duong ABC, Quan X', '0123456789', 'nguyenvana@example.com', '123456789012',
    'anhcccd1.jpg', 'anh3x4_1.jpg', '2024-01-01', 'TPHCM', 'Nguyen Thi B', '0987654321', 'Giao Vien', 'Tap Luyen 2023',
    'Thi 2023', 'Cao Dang', '12', 'Hanh Phuc', 1
);

-- Thêm dữ liệu vào bảng kết quả thi
INSERT INTO ketquathi (maMonSinh, maKhoaThi, capDaiHienTai, capDaiDuThi, ketQua, trangThaiHoSo, ghiChu, ngayCham) VALUES
(1, 1, 2, 1, 1, 1, 'Đạt yêu cầu', '2024-07-16');

-- Thêm dữ liệu vào bảng chi tiết kết quả thi
INSERT INTO chitietketquathi (maKetQuaThi, maKyThuat, diemDon, diemCan, diemSong, diemDoi, diemLyThuyet, diemTheLuc, tongDiem, ketQua, ghiChu, tenDangNhap) VALUES
(1, 1, 8.0, 9.0, 7.5, 8.5, 9.0, 8.0, 50.0, 1, 'Đạt yêu cầu', 'nguyenvana');