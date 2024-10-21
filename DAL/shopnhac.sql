-- Tạo bảng roles
CREATE TABLE roles (
    codeRole INT AUTO_INCREMENT PRIMARY KEY,
    nameRole VARCHAR(255)
);

-- Tạo bảng permissions
CREATE TABLE permissions (
    codePermission INT AUTO_INCREMENT PRIMARY KEY,
    namePermission VARCHAR(255)
);

-- Tạo bảng roles_permissions
CREATE TABLE roles_permissions(
    role_permission_id INT AUTO_INCREMENT PRIMARY KEY,
    codeRole INT, -- Khóa ngoại từ bảng roles
    codePermission INT, -- Khóa ngoại từ bảng permissions
    FOREIGN KEY (codeRole) REFERENCES roles(codeRole),
    FOREIGN KEY (codePermission) REFERENCES permissions(codePermission)
);

-- Tạo bảng accounts
CREATE TABLE accounts (
    userName VARCHAR(255) PRIMARY KEY NOT NULL,
    passWord VARCHAR(255),
    email VARCHAR(255),
    fullName VARCHAR(255),
    phoneNumber VARCHAR(255),
    avatar VARCHAR(255),
    active TINYINT(1) Default 1,
    dateCreated DATE,
    codeRole INT, -- Khóa ngoại từ bảng roles
    FOREIGN KEY (codeRole) REFERENCES roles(codeRole)
);

-- Tạo bảng subjects
CREATE TABLE subjects (
    idSubject INT AUTO_INCREMENT PRIMARY KEY,
    nameSubject VARCHAR(255),
    imgSubject VARCHAR(255)
);

-- Tạo bảng categories
CREATE TABLE categories (
    idCategory INT AUTO_INCREMENT PRIMARY KEY,
    nameCategory VARCHAR(255),
    imgCategory VARCHAR(255),
    idSubject INT, -- Khóa ngoại từ bảng subjects
    FOREIGN KEY (idSubject) REFERENCES subjects(idSubject)
);

-- Tạo bảng singers
CREATE TABLE singers (
    idSinger INT AUTO_INCREMENT PRIMARY KEY,
    nameSinger VARCHAR(255),
    avatar VARCHAR(255)
);

-- Tạo bảng albums
CREATE TABLE albums (
    idAlbum INT AUTO_INCREMENT PRIMARY KEY,
    nameAlbum VARCHAR(255),
    imgAlbum VARCHAR(255),
    dateCreated DATE,
    idSinger INT, -- khóa ngoại từ bảng singer
    userName VARCHAR(255), -- khóa ngoại từ bảng users
    FOREIGN KEY (idSinger) REFERENCES singers(idSinger),
    FOREIGN KEY (userName) REFERENCES accounts(userName)
); 

-- Tạo bảng playlists
CREATE TABLE playlists (
    idPlaylist INT AUTO_INCREMENT PRIMARY KEY,
    namePlaylist VARCHAR(255),
    imagePlaylist VARCHAR(255),
    icon VARCHAR(255)
); 

-- Tạo bảng songs
CREATE TABLE songs (
    idSong INT AUTO_INCREMENT PRIMARY KEY,
    nameSong VARCHAR(255),
    imageSong VARCHAR(255),
    linkSong VARCHAR(255),
    countListen INT,
    timeSong time,
    dateCreated DATE,
    idCategory INT, -- khóa ngoại từ bảng categories
    idPlaylist INT, -- khóa ngoại từ bảng playlists
    idAlbum INT, -- khóa ngoại từ bảng albums
    idSinger INT, -- khóa ngoại từ bảng singers
    userName VARCHAR(255), -- khóa ngoại từ bảng users
    FOREIGN KEY (idCategory) REFERENCES categories(idCategory),
    FOREIGN KEY (idPlaylist) REFERENCES playlists(idPlaylist),
    FOREIGN KEY (idAlbum) REFERENCES albums(idAlbum),
    FOREIGN KEY (idSinger) REFERENCES singers(idSinger),
    FOREIGN KEY (userName) REFERENCES accounts(userName)
);

-- Tạo bảng advertisements
CREATE TABLE advertisements (
    idAdvertisement INT AUTO_INCREMENT PRIMARY KEY,
    content VARCHAR(255),
    imgAdvertisement VARCHAR(255),
    idSong INT, -- khóa ngoại từ bảng songs
    FOREIGN KEY (idSong) REFERENCES songs(idSong)
);


