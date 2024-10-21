-- khởi tạo dữ liệu cho database


-- data table function
USE  website_sells_clothes_and_bags;
INSERT INTO functions
       (functionCode, functionName)
VALUES
       ('feedback', 'Quản lý phản hồi'),
       ('comment', 'Quản lý bình luận'),
       ('account', 'Quản lý tài khoản'),
       ('order', 'Quản lý đơn hàng'),
       ('product', 'Quản lý sản phẩm'),
       ('size', 'Quản lý kích thước sản phẩm áo'),
       ('payment', 'Quản lý hình thức thanh toán'),
       ('transport', 'Quản lý hình thức vận chuyển'),
       ('supplier', 'Quản lý nhà cung cấp');

-- check data table function
USE  website_sells_clothes_and_bags;
SELECT *
FROM functions



-- data table permission
USE  website_sells_clothes_and_bags;
INSERT INTO permissions
       (codePermissions, namePermissions)
VALUES
       -- quyền user và admin là quyền không thể bị xóa
       -- nếu khác quyền user thì sẽ chuyển trang vô trang admin
       ('user', 'Quyền quản trị người dùng'),
       ('admin', 'Quyền quản trị admin');
-- 2 quyền bên dưới mốt tính sau
-- ('staff_partime', 'Quyền quản trị nhân viên partime'),
-- ('staff_fulltime', 'Quyền quản trị nhân viên fulltime');

-- check data table permissons
USE  website_sells_clothes_and_bags;
SELECT *
FROM permissions


-- data table permissonsdetail
USE  website_sells_clothes_and_bags;
INSERT INTO permissionsdetail
       (codePermissions, functionCode, addPermission, seePermission, deletePermission, fixPermission)
VALUES
       -- user: chỉ có thể xem 
       ('user', 'feedback', 0, 1, 0, 0),
       ('user', 'comment', 0, 1, 0, 0),
       ('user', 'account', 0, 1, 0, 0),
       ('user', 'order', 0, 1, 0, 0),
       ('user', 'product', 0, 1, 0, 0),
       ('user', 'size', 0, 1, 0, 0),
       ('user', 'payment', 0, 1, 0, 0),
       ('user', 'transport', 0, 1, 0, 0),
       ('user', 'supplier', 0, 1, 0, 0),

       -- admin: có quyền toàn hệ thống
       ('admin', 'feedback', 1, 1, 1, 1),
       ('admin', 'comment', 1, 1, 1, 1),
       ('admin', 'account', 1, 1, 1, 1),
       ('admin', 'order', 1, 1, 1, 1),
       ('admin', 'product', 1, 1, 1, 1),
       ('admin', 'size', 1, 1, 1, 1),
       ('admin', 'payment', 1, 1, 1, 1),
       ('admin', 'transport', 1, 1, 1, 1),
       ('admin', 'supplier', 1, 1, 1, 1);

-- staff partime: nhân viên partime chỉ có thể: order(xem,sửa), comment(xem,thêm,xóa,sửa)


-- check data table permissonsdetail
USE  website_sells_clothes_and_bags;
SELECT *
FROM permissionsdetail




-- data table accounts
USE  website_sells_clothes_and_bags;
INSERT INTO accounts
       (userName, passWord, dateCreated, accountStatus, name, address, email, phoneNumber, birth, sex, codePermissions)
VALUES
       ('UGh1Y0FwdVRydW9uZw==', 'MTIzNDU2', '2024-03-14', '1', 'Trương Công Phúc', '123 Main St', 'truongphuc056@gmail.com', '0823072871', '2003-06-10', 'Male', 'admin'),

       ('QWxpY2VKb2huc29u', 'YWJjZGVm', '2024-03-16', '1', 'Alice Johnson', '1010 Pine St', 'alice@example.com', '0823072871', '1995-02-15', 'Female', 'user'),

       ('RmF0bm90UGhhdA==', 'MTIzNDU2', '2024-03-14', '1', 'Trần Tiến Phát', '123 Main St', 'Fat@gmail.com', '0823072871', '2003-01-01', 'Male', 'admin'),
       
       ('Sm9obkRvZQ==', 'cGFzc3dvcmQxMjM=', '2024-03-15', '1', 'John Doe', '456 Elm St', 'john@example.com', '0823072871', '1990-05-20', 'Male', 'user'),
       
       ('SmFuZVNtaXRo', 'cXdlcnR5', '2024-03-15', '1', 'Jane Smith', '789 Oak St', 'jane@example.com', '0823072871', '1985-08-10', 'Female', 'user'),
       
       ('Qm9iQnJvd24=', 'aGVsbG8xMjM=', '2024-03-16', '1', 'Bob Brown', '1212 Maple St', 'bob@example.com', '0823072871', '1988-11-25', 'Male', 'user'),
       
       ('RW1pbHlEYXZpcw==', 'aWxvdmVjYXRz', '2024-03-17', '1', 'Emily Davis', '1414 Cedar St', 'emily@example.com', '0823072871', '1992-04-30', 'Female', 'user');

-- check data table accounts
USE  website_sells_clothes_and_bags;
SELECT *
FROM accounts


-- data table product
USE  website_sells_clothes_and_bags;
INSERT INTO Supplier
       (codeSupplier, nameSupplier, address, email, brandSupplier, phoneNumber)
VALUES
       ('NCC001', 'Gucci store branch 2', '123 An Dương Vương, Hồ Chí Minh, Quận 5', 'GUCCI@gmail.com', 'GUCCI', '0823072871'),
       ('NCC002', 'Nike store branch SaiGon', '185 An Dương Vương, Hồ Chí Minh , Quận 5', 'NIKE@gmail.com', 'NIKE', '0823072871'),
       ('NCC003', 'Adidas store branch SaiGon', '132 An Dương Vương, Hồ Chí Minh , Quận 5', 'ADIDAS@gmail.com', 'ADIDAS', '0823072871'),
       ('NCC004', 'Chanel store branch LongAn', '85 Võ Thị Kế, Long An , Tân An', 'CHANEL@gmail.com', 'CHANEL', '0823072871');

-- check data table Supplier
USE  website_sells_clothes_and_bags;
SELECT *
FROM supplier





-- data table product
USE  website_sells_clothes_and_bags;
INSERT INTO Product
       (productCode, imgProduct, nameProduct, supplierCode, quantity, describeProduct, status, color, targetGender, price, promotion)
VALUES
       (
              'P001', -- mã sãn phẩm
              '../image/product/product1/product-detail-1.png ../image/product/product1/product-detail-2.png ../image/product/product1/product-detail-3.png ../image/product/product1/product-detail-4.png', -- ảnh chi tiết sản phẩm
              'Jumpsuit quấn siêu mềm', -- tên sản phẩm
              'NCC001', -- mã nhà cung cấp
              50,
              'Jumpsuit Quấn Siêu Mềm: Sự Hoàn Hảo Của Sự Thư Thái

              Trong thế giới thời trang hiện đại, sự thoải mái và phong cách không chỉ là mục tiêu mà còn là một trải nghiệm. Và giữa những xu hướng đa dạng, Jumpsuit Quấn Siêu Mềm nổi bật như một điểm đến lý tưởng cho những người phụ nữ tìm kiếm sự thoải mái và thanh lịch trong một bộ trang phục đơn giản nhưng không kém phần sang trọng.

              Ngay từ cái nhìn đầu tiên, Jumpsuit Quấn Siêu Mềm thu hút với sự đẹp mắt của chất liệu siêu mềm, êm ái và mịn màng. Với việc sử dụng chất liệu cao cấp như lụa hoặc chiffon, bộ jumpsuit không chỉ mang lại cảm giác thoải mái mà còn tạo nên sự sang trọng, quyến rũ mỗi khi mặc.

              Sự linh hoạt của Jumpsuit Quấn Siêu Mềm cũng là một điểm đáng chú ý. Với thiết kế quấn đơn giản nhưng tinh tế, bộ jumpsuit này mang lại khả năng điều chỉnh dễ dàng, giúp phù hợp với mọi dáng vóc và kích cỡ cơ thể. Không cần phải lo lắng về việc chọn size phù hợp, mỗi người phụ nữ đều có thể tìm thấy sự thoải mái và vẻ đẹp riêng của mình trong Jumpsuit Quấn Siêu Mềm.

              Điểm nhấn của bộ trang phục này chính là sự đa dạng trong phong cách. Dễ dàng kết hợp với các phụ kiện như dây nịt, giày cao gót hay sneakers, Jumpsuit Quấn Siêu Mềm có thể biến hóa từ phong cách nữ tính đến cá tính, từ dịu dàng đến năng động, phản ánh đầy đủ cá tính và phong cách riêng của người mặc.

              Cuối cùng, không thể phủ nhận rằng Jumpsuit Quấn Siêu Mềm là lựa chọn lý tưởng cho những buổi tiệc, dạo phố hay thậm chí là những buổi hẹn hò lãng mạn. Sự thoải mái, linh hoạt và phong cách của bộ jumpsuit này chắc chắn sẽ làm nổi bật và tự tin cho bất kỳ ai mặc nó. Trải nghiệm Jumpsuit Quấn Siêu Mềm, bạn sẽ không chỉ cảm nhận sự thoải mái mà còn khám phá ra sự hoàn hảo trong sự thư thái và phong cách.', -- mo ta
              '1', -- trạng thái 
              'pink', -- màu
              'Male', -- đối tượng hướng đến
              39.99, -- giá
              20 -- giảm giá
       ),
       (
              'P002', -- mã sãn phẩm
              '../image/product/product2/product-detail-1.png ../image/product/product2/product-detail-2.png ../image/product/product2/product-detail-3.png ../image/product/product2/product-detail-4.png', -- ảnh chi tiết sản phẩm
              'JDenim playsuit', -- tên sản phẩm
              'NCC001', -- mã nhà cung cấp
              50,
              'JDenim Playsuit: Sự Kết Hợp Hoàn Hảo Giữa Phong Cách và Sự Tiện Lợi

              Trong thế giới thời trang đương đại, sự đa dạng và tính ứng dụng luôn được đặt lên hàng đầu. Và JDenim Playsuit chính là một minh chứng sống động cho sự kết hợp hoàn hảo giữa phong cách thời trang và sự tiện lợi.

              JDenim Playsuit là sự hòa quyện tuyệt vời giữa jeans và jumpsuit, mang lại cảm giác thoải mái nhưng vẫn giữ được vẻ năng động và cá tính. Được làm từ chất liệu denim chất lượng cao, bộ playsuit này không chỉ đảm bảo độ bền và độ co giãn tốt mà còn tạo nên sự thoải mái và tự tin cho người mặc.

              Với thiết kế đơn giản nhưng không kém phần cuốn hút, JDenim Playsuit là sự lựa chọn hoàn hảo cho những người phụ nữ yêu thích phong cách năng động và trẻ trung. Dây đai điều chỉnh ở eo giúp tạo ra sự vừa vặn và phù hợp cho mọi dáng người, đồng thời tạo điểm nhấn cho toàn bộ trang phục.

              Sự linh hoạt của JDenim Playsuit cũng là một điểm đáng chú ý. Với khả năng kết hợp dễ dàng với các phụ kiện như giày sneakers, sandal hoặc boots, bộ playsuit này có thể phù hợp với nhiều dịp khác nhau, từ đi chơi dạo phố đến các buổi tiệc hay dự lễ hội.', -- mo ta
              '1', -- trạng thái 
              'blue', -- màu
              'Male', -- đối tượng hướng đến
              39.99, -- giá
              0 -- giảm giá
       ),
       (
              'P003', -- mã sãn phẩm
              '../image/product/product3/product-detail-1.png ../image/product/product3/product-detail-2.png ../image/product/product3/product-detail-3.png ../image/product/product3/product-detail-4.png ../image/product/product3/product-detail-5.png ../image/product/product3/product-detail-6.png', -- ảnh chi tiết sản phẩm
              'Halterneck jumpsuit', -- tên sản phẩm
              'NCC001', -- mã nhà cung cấp
              50,
              'Halterneck Jumpsuit: Sự Gợi Cảm và Thanh Lịch Trên Mỗi Bước Đường

              Trong thế giới thời trang hiện đại, sự kết hợp giữa sự gợi cảm và sự thoải mái luôn là điều được ưa chuộng, và Halterneck Jumpsuit không phải là một ngoại lệ. Với thiết kế độc đáo và thanh lịch, bộ jumpsuit này mang lại sự tự tin và quyến rũ cho người mặc, đồng thời giữ cho họ cảm thấy thoải mái suốt cả ngày dài.

              Halterneck Jumpsuit nổi bật với phần trên được cắt xẻ tinh tế, tạo ra dáng cổ áo hình chữ V hoặc hình tam giác đầy gợi cảm, làm nổi bật vòng 1 và tôn lên vóc dáng của người mặc. Các dây đeo chéo sau cổ tạo điểm nhấn và giúp điều chỉnh vừa vặn cho mọi dáng người.

              Với phần quần được cắt dài hoặc ngắn tùy thuộc vào phong cách, Halterneck Jumpsuit thường được làm từ các chất liệu như lụa, satin, hoặc chiffon, tạo ra sự mềm mại và mượt mà, khiến người mặc cảm nhận được sự thoải mái và tự tin mỗi khi diện lên.

              Khả năng linh hoạt của Halterneck Jumpsuit cũng là một điểm cộng lớn. Bạn có thể mặc nó trong những dịp quan trọng như tiệc tùng, dự lễ cưới, hoặc một buổi hẹn hò lãng mạn. Đồng thời, nó cũng phù hợp cho những buổi dạo phố, đi chơi cùng bạn bè, hoặc thậm chí là một buổi học nhẹ nhàng.', -- mo ta
              '1', -- trạng thái 
              'black', -- màu
              'Male', -- đối tượng hướng đến
              39.99, -- giá
              0 -- giảm giá
       ),
       (
              'P004',
              '../image/product/product4/product-detail-1.png ../image/product/product4/product-detail-2.png ../image/product/product4/product-detail-3.png ../image/product/product4/product-detail-4.png',
              'Denim jumpsuit',
              'NCC002',
              50,
              'Áo denim jumpsuit là một bộ jumpsuit được làm từ vải denim - một loại vải jean chắc chắn và bền. Thiết kế của nó thường bao gồm cả áo và quần, tạo ra một kiểu dáng trang phục đơn giản nhưng vô cùng thoải mái và thời trang. Áo denim jumpsuit thường có các chi tiết thiết kế như túi, khuy cài và đường may độc đáo, tạo điểm nhấn và phong cách cho bộ jumpsuit.
              Nó phù hợp với nhiều dịp và có thể kết hợp với nhiều loại phụ kiện và giày dép khác nhau để tạo ra vẻ ngoài phong cách và đa dạng.',
              '1',
              'Dark Blue',
              'Female',
              39.99,
              0
       ),
       (
              'P005',
              '../image/product/product5/product-detail-1.png ../image/product/product5/product-detail-2.png ../image/product/product5/product-detail-3.png ../image/product/product5/product-detail-4.png ../image/product/product5/product-detail-5.png' ,
              'Linen T-Shirt',
              'NCC003',
              50,
              'Linen T-Shirt là một áo thun được làm từ chất liệu linen tự nhiên, mang lại sự thoải mái và thoáng mát cho người mặc trong mùa hè nóng bức. Với kiểu dáng cổ tròn hoặc cổ V đơn giản nhưng tinh tế, cùng với đa dạng màu sắc từ những gam trung tính đến màu sắc tươi sáng, nó không chỉ là một lựa chọn tiện lợi mà còn là một phần không thể thiếu trong tủ đồ của bất kỳ ai. Sự linh hoạt trong việc kết hợp với nhiều loại quần áo khác nhau từ quần jeans đến chinos hay quần short, tạo ra nhiều phong cách trang phục khác nhau,
              làm cho Linen T-Shirt trở thành một lựa chọn phổ biến và thời trang cho các buổi dạo phố, du lịch hay những cuộc gặp gỡ bạn bè.',
              '1',
              'Brown',
              'Female',
              14.99,
              0
       ),
       (
              'P006',
              '../image/product/product6/product-detail-1.png ../image/product/product6/product-detail-2.png ../image/product/product6/product-detail-3.png ../image/product/product6/product-detail-4.png ../image/product/product6/product-detail-5.png ../image/product/product6/product-detail-6.png ../image/product/product6/product-detail-7.png',
              'Oversized printed T-shirt',
              'NCC004',
              50,
              'Oversized printed T-shirt là một chiếc áo thun có kiểu dáng rộng lớn hơn so với các áo thun thông thường, tạo ra một phong cách thoải mái và phóng khoáng. Đặc điểm chính của sản phẩm này bao gồm:

              1. Form rộng: Oversized printed T-shirt có kiểu dáng rộng hơn so với áo thun thông thường, tạo ra một vẻ ngoài thoải mái và phóng khoáng.

              2. In hình: Áo thường có hình in được in trên bề mặt, có thể là hình ảnh, họa tiết hoặc thông điệp, tạo điểm nhấn và phong cách cho sản phẩm.

              3. Chất liệu: Thường được làm từ vải cotton thoáng mát và mềm mại, đảm bảo sự thoải mái cho người mặc.

              4. Phong cách đa dạng: Oversized printed T-shirt có thể được kết hợp với nhiều loại quần áo khác nhau như quần jean, quần short hoặc chân váy, phù hợp cho nhiều dịp khác nhau từ dạo phố đến các sự kiện thư giãn.

              5. Tính thời trang: Với kiểu dáng phóng khoáng và hình in độc đáo, Oversized printed T-shirt thường là một lựa chọn phổ biến cho những người muốn thể hiện phong cách cá nhân và sự tự tin trong trang phục.

              Tóm lại, Oversized printed T-shirt là một sản phẩm thời trang với kiểu dáng rộng lớn và hình in độc đáo, mang lại sự thoải mái và phong cách cho người mặc.',
              '1',
              'White',
              'Female',
              22.99,
              31
       ),
       (
              'P007',
              '../image/product/product7/product-detail-1.png ../image/product/product7/product-detail-2.png ../image/product/product7/product-detail-3.png ../image/product/product7/product-detail-4.png ../image/product/product7/product-detail-5.png ../image/product/product7/product-detail-6.png',
              'Printed T-shirt',
              'NCC002',
              50,
              'Printed T-Shirt là một chiếc áo thun được in hình hoặc họa tiết trực tiếp lên bề mặt vải. Các hình in có thể là hình ảnh, các đồ họa hoặc các thông điệp. Với sự kết hợp giữa thiết kế đơn giản của áo thun và các hình in độc đáo, sản phẩm này tạo ra một phong cách cá nhân và nổi bật cho người mặc. Chất liệu thường là cotton, tạo cảm giác thoải mái và dễ chịu khi mặc.
              Printed T-Shirt thường được sử dụng cho nhiều dịp từ hàng ngày đến đi dạo phố, tạo nên một diện mạo trẻ trung và sành điệu.',
              '1',
              'Black',
              'Female',
              20.00,
              25
       ),
       (
              'P008',
              '../image/product/product8/product-detail-1.png ../image/product/product8/product-detail-2.png ../image/product/product8/product-detail-3.png ../image/product/product8/product-detail-4.png ../image/product/product8/product-detail-5.png',
              'Cotton T-Shirt',
              'NCC004',
              50,
              'Cotton T-Shirt là một chiếc áo thun được làm từ chất liệu cotton, một loại vải mềm mại, thoáng mát và dễ chịu cho làn da. Đặc điểm của sản phẩm này bao gồm:

              1. Chất liệu cotton: Áo thun được làm từ cotton, là loại vải tự nhiên phổ biến nhất, giúp thoát khí và hút ẩm tốt, mang lại cảm giác thoải mái và dễ chịu khi mặc.

              2. Kiểu dáng đơn giản: Cotton T-Shirt thường có kiểu dáng đơn giản với cổ tròn hoặc cổ V, tay ngắn và có thể có hoặc không có túi, tạo sự thuận tiện và phù hợp cho nhiều dịp.

              3. Màu sắc đa dạng: Sản phẩm này có thể có nhiều màu sắc khác nhau từ các gam màu trung tính như trắng, xám, và đen đến các màu sắc tươi sáng như xanh dương, hồng, và vàng, đáp ứng nhu cầu và sở thích của người mặc.

              4. Phong cách đa dạng: Cotton T-Shirt là một sản phẩm cơ bản và linh hoạt, dễ dàng kết hợp với nhiều loại trang phục khác nhau, từ quần jean đến quần short hoặc chân váy, phù hợp cho nhiều hoàn cảnh và dịp khác nhau.

              5. Độ bền cao: Với chất liệu cotton chất lượng, Cotton T-Shirt thường có độ bền cao và dễ bảo quản, có thể giữ form dáng và màu sắc sau nhiều lần giặt.

              Tóm lại, Cotton T-Shirt là một sản phẩm cơ bản và phổ biến, mang lại sự thoải mái, linh hoạt và phong cách cho người mặc trong mọi hoàn cảnh.',
              '1',
              'white',
              'Female',
              9.99,
              0
       ),
       (
              'P009',
              '../image/product/product9/product-detail-1.png ../image/product/product9/product-detail-2.png ../image/product/product9/product-detail-3.png ../image/product/product9/product-detail-4.png ../image/product/product9/product-detail-5.png ../image/product/product9/product-detail-6.png ../image/product/product9/product-detail-7.png',
              'Oversized crinkled shirt',
              'NCC004',
              50,
              'Oversized crinkled shirt là một kiểu áo sơ mi có kiểu dáng rộng lớn và đặc trưng với bề mặt vải được tạo thành từ các nếp nhăn tự nhiên, tạo ra một vẻ ngoài ấn tượng và phóng khoáng.
              Sản phẩm này thường mang lại sự thoải mái và phong cách độc đáo cho người mặc, phù hợp cho nhiều hoàn cảnh khác nhau từ casual đến semi-formal.',
              '1',
              'Yellow',
              'Female',
              20.00,
              0
       ),
       (
              'P010',
              '../image/product/product10/product-detail-1.png ../image/product/product10/product-detail-2.png ../image/product/product10/product-detail-3.png ../image/product/product10/product-detail-4.png ../image/product/product10/product-detail-5.png ../image/product/product10/product-detail-6.png',
              'Linen-blend pop-over shirt',
              'NCC002',
              50,
              'Linen-blend pop-over shirt là một loại áo sơ mi được làm từ sự kết hợp giữa vải linen và các loại vải khác. "Pop-over" chỉ phong cách của cách mặc, có nghĩa là không có nút cài phía trước, thay vào đó, bạn chỉ cần "pop" áo qua đầu để mặc. Đây thường là một thiết kế linh hoạt và thoải mái, phổ biến trong các bộ sưu tập thời trang dành cho mùa hè. Đặc điểm của sản phẩm này bao gồm:

              1. Chất liệu Linen-blend: Sự kết hợp giữa linen và các loại vải khác mang lại sự kết hợp lý tưởng giữa tính thoáng khí của linen và tính linh hoạt của vải khác, tạo ra sự thoải mái và bền bỉ cho người mặc.

              2. Kiểu dáng Pop-over: Với kiểu dáng này, áo sơ mi thường không có nút cài phía trước, giúp bạn mặc dễ dàng hơn chỉ bằng cách "pop" qua đầu. Điều này tạo ra một vẻ ngoài không chỉ phóng khoáng mà còn hiện đại và thời trang.

              3. Thiết kế thoải mái: Linen-blend pop-over shirt thường có kiểu dáng rộng rãi và cổ áo lỏng lẻo, mang lại sự thoải mái và sự linh hoạt trong mọi hoàn cảnh.

              4. Phong cách dễ kết hợp: Sản phẩm này dễ dàng kết hợp với nhiều loại quần áo khác nhau từ quần jeans đến quần shorts hoặc chân váy, tạo ra nhiều phong cách trang phục khác nhau cho mùa hè.

              5. Thích hợp cho mùa hè: Với chất liệu thoáng khí và kiểu dáng lỏng lẻo, Linen-blend pop-over shirt thường là lựa chọn phổ biến cho mùa hè, giúp bạn thoải mái và phong cách trong những ngày nắng nóng.

              Tóm lại, Linen-blend pop-over shirt là một sản phẩm sơ mi linh hoạt, thoải mái và thời trang, phù hợp cho những người muốn thoải mái mà vẫn đảm bảo phong cách trong mùa hè.',
              '1',
              'White',
              'Female',
              35.00,
              0
       ),
       (
              'P011',
              '../image/product/product11/product-detail-1.png ../image/product/product11/product-detail-2.png ../image/product/product11/product-detail-3.png ../image/product/product11/product-detail-4.png ../image/product/product11/product-detail-5.png ../image/product/product11/product-detail-6.png ../image/product/product11/product-detail-7.png',
              'V-neck blouse',
              'NCC004',
              50,
              'V-neck blouse là một loại áo dài có kiểu cổ V, thường được làm từ vải mềm mại và nhẹ nhàng như cotton, satin, hoặc chiffon. Đặc điểm của sản phẩm này bao gồm:

              1. Kiểu cổ V: Với kiểu cổ này, áo có phần cổ được cắt hình chữ V, tạo điểm nhấn cho vòng cổ và tạo ra vẻ đẹp thanh lịch và nữ tính.

              2. Chất liệu: Thường làm từ các loại vải mềm mại và thoáng khí như cotton, satin, hoặc chiffon, giúp áo thoải mái và dễ chịu khi mặc.

              3. Kiểu dáng: Blouse thường có kiểu dáng phổ biến với tay áo dài hoặc tay áo 3/4, có thể đi kèm với các chi tiết như nơ, ren, hoặc cúc để tăng thêm sự sang trọng và nữ tính.

              4. Phong cách đa dạng: Với kiểu dáng cổ V trẻ trung và thanh lịch, v-neck blouse thích hợp cho nhiều dịp từ công việc đến dạo phố hay các buổi tiệc.

              5. Kết hợp trang phục: Áo V-neck blouse dễ dàng kết hợp với nhiều loại quần áo khác nhau, từ quần jeans đến chân váy hoặc quần âu, tạo ra nhiều phong cách trang phục khác nhau.

              Với sự thanh lịch và nữ tính của kiểu cổ V, V-neck blouse là một lựa chọn phổ biến cho phụ nữ muốn thể hiện phong cách trang nhã và đẳng cấp.',
              '1',
              'white',
              'Female',
              20.00,
              20
       ),
       (
              'P012',
              '../image/product/product12/product-detail-1.png ../image/product/product12/product-detail-2.png ../image/product/product12/product-detail-3.png ../image/product/product12/product-detail-4.png ../image/product/product12/product-detail-5.png ../image/product/product12/product-detail-6.png',
              'Oxford shirt',
              'NCC003',
              50,
              'Oxford shirt là một loại áo sơ mi có kiểu dáng cổ button-down, được làm từ vải oxford - một loại vải dày và bền. Đặc điểm của áo Oxford shirt bao gồm:

              Kiểu dáng cổ button-down: Cổ áo của Oxford shirt có nút cài xuống, giúp giữ form áo và tạo điểm nhấn truyền thống và lịch lãm.

              Chất liệu Oxford: Sử dụng vải oxford, một loại vải dày và có cấu trúc chắc chắn, tạo ra sự bền bỉ và khả năng giữ form dáng tốt.

              Kiểu dáng sơ mi: Oxford shirt thường có kiểu dáng sơ mi truyền thống với tay áo dài và phần dưới hơi hẹp hơn, tạo ra vẻ ngoài lịch lãm và chuyên nghiệp.

              Màu sắc đa dạng: Sản phẩm này có thể có nhiều màu sắc khác nhau, từ các gam màu trung tính như trắng, xám, và xanh navy đến các màu sắc tươi sáng như đỏ, xanh dương, và hồng.

              Phong cách đa dạng: Oxford shirt là một trang phục cơ bản và đa dụng, phù hợp cho nhiều dịp từ công việc đến dạo phố hay các buổi tiệc. Có thể kết hợp với quần âu, quần jean hoặc chinos.

              Với sự kết hợp giữa kiểu dáng truyền thống và chất liệu vải chắc chắn, Oxford shirt thường được xem là một lựa chọn ổn định và lịch lãm trong tủ đồ của đàn ông.',
              '1',
              'Blue',
              'Female',
              18.99,
              0
       ),
       (
              'P013',
              '../image/product/product13/product-detail-1.png ../image/product/product13/product-detail-2.png ../image/product/product13/product-detail-3.png ../image/product/product13/product-detail-4.png',
              'Women’s Double Gauze Long Sleeve Button Down Shirt',
              'NCC001',
              50,
              'Women’s Double Gauze Long Sleeve Button Down Shirt là một loại áo sơ mi dài tay dành cho phụ nữ, được làm từ vải gấm kép (double gauze). Đặc điểm của sản phẩm này bao gồm:

              Vải gấm kép (Double Gauze): Là loại vải được làm từ hai lớp vải gấm mỏng, tạo ra cảm giác mềm mại và thoáng khí. Điều này mang lại sự thoải mái và dễ chịu khi mặc trong nhiều điều kiện thời tiết.

              Kiểu dáng cổ button-down: Áo có cổ áo có nút cài xuống, giúp điều chỉnh được mức độ thoải mái và phong cách theo ý muốn.

              Tay áo dài: Với tay áo dài, sản phẩm này thích hợp để mặc vào mùa thu hoặc mùa đông, mang lại sự ấm áp và thoải mái cho người mặc.

              Thiết kế nữ tính: Double Gauze Long Sleeve Button Down Shirt thường có các chi tiết thiết kế nữ tính như form áo ôm vừa, các đường may tỉ mỉ, và các chi tiết như cổ nơ hoặc túi trước, tạo ra vẻ ngoài dễ thương và duyên dáng.

              Phong cách đa dạng: Sản phẩm này có thể phù hợp cho nhiều dịp khác nhau, từ công việc đến các buổi dạo phố hoặc đi chơi cuối tuần. Có thể kết hợp với quần jean, chân váy hoặc quần âu tạo ra nhiều phong cách trang phục khác nhau.

              Áo sơ mi Double Gauze Long Sleeve Button Down Shirt là một lựa chọn phổ biến cho phụ nữ muốn kết hợp giữa sự thoải mái, nữ tính và phong cách trong trang phục hàng ngày.',
              '1',
              'Green',
              'Female',
              30.98,
              0
       ),
       (
              'P014',
              '../image/product/product14/product-detail-1.jpg ../image/product/product14/product-detail-2.jpg ../image/product/product14/product-detail-3.jpg',
              'Poloman Shirt',
              'NCC004',
              50,
              'Áo Thun Polo màu Trắng phối viền, Áo Thun Có Cổ màu Trắng phối viền phong cách lịch lãm dạo phố của POLO B and W SHOP là 1 chiếc áo thun nam có cổ hoàn hảo dành cho phái mạnh với thiết kế tôn dáng, những đường kẻ sọc nam tính, logo thêu thương hiệu tinh tế và thanh lịch. 
              Sản phẩm có Video quay trực tiếp sản phẩm để khách hàng tham khảo. 
              Thông tin sản phẩm Áo thun Polo phong cách lịch lãm dạo phố: 
              - Chât liệu thun cá sấu, chất nhẵn, mát, độ bền cao, chất vải lên form đẹp. 
              - Vải cá sấu chuẩn form tạo sự thanh lịch cho phái mạnh. 
              - Công nghệ sợi vải dệt tiêu chuẩn giúp thấm hút mồ hôi và kháng khuẩn. 
              - Form áo thiết kế rộng rãi thoải mái dáng đứng phù hợp cho mọi hoạt động trong ngày. 
              - Xuất xứ: Việt Nam. 
              Hình in: Đảm bảo công nghệ in cao cấp nhất, giữ độ bền và nét đẹp lâu dài. 
              Áo Thun Polo màu Trắng phối viền, Áo Thun Có Cổ màu Trắng phối viền phong cách lịch lãm dạo phố của POLO B and W SHOP là sản phẩm chắc chắn bạn phải có trong tủ quần áo với bảng màu vô cùng đa dạng, giúp bạn có thể thay đổi phong cách hàng ngày.',
              '1',
              'Black',
              'Male',
              34.00,
              0
       ),
       (
              'P015',
              '../image/product/product15/product-detail-1.jpg ../image/product/product15/product-detail-2.jpg ../image/product/product15/product-detail-3.jpg',
              'Trouser Man',
              'NCC002',
              50,
              '- Quần âu nam ống côn sẽ giúp các chàng trông chuẩn soái ca.
              - Trong tủ có e này thì cực dễ phối đồ: sơmi, thun, vest đều đẹp
              - Chất Liệu: Vải lụa co giãn nhẹ, mềm mịn , Mỏng nhẹ
              - Giá Thành Tiết kiệm chi phí cho mình , sản phẩm dùng để mặc hằng ngày đi làm đi học',
              '1',
              'Black',
              'Male',
              20.00,
              0
       ),
       (
              'P016',
              '../image/product/product16/product-detail-1.jpg ../image/product/product16/product-detail-2.jpg ../image/product/product16/product-detail-3.jpg',
              'Short Denim',
              'NCC004',
              50,
              'Short denim là một loại quần ngắn được làm từ vải denim, thường có kiểu dáng đơn giản và thường được sử dụng trong mùa hè. Đặc điểm của short denim bao gồm:

              Chất liệu denim: Sử dụng vải denim, một loại vải jean chắc chắn và bền, mang lại sự thoải mái và độ bền cho người mặc.

              Kiểu dáng ngắn: Short denim thường có kiểu dáng ngắn, khoe đôi chân và tạo sự thoải mái cho người mặc trong mùa nắng nóng.

              Thiết kế đơn giản: Thường có thiết kế đơn giản với các chi tiết như túi, khuy cài và đường may tỉ mỉ, tạo điểm nhấn cho sản phẩm.

              Phong cách đa dạng: Short denim có thể kết hợp với nhiều loại áo và phụ kiện khác nhau để tạo ra phong cách trang phục cá nhân và thời trang cho người mặc.

              Thích hợp cho mùa hè: Với chất liệu thoáng khí và kiểu dáng ngắn, short denim là lựa chọn phổ biến cho mùa hè, phù hợp cho các hoạt động ngoài trời và du lịch.

              Với sự kết hợp giữa chất liệu denim chắc chắn và kiểu dáng ngắn thoải mái, short denim là một lựa chọn phổ biến và thời trang cho mùa hè.',
              '1',
              'Black',
              'Male',
              19.99,
              0
       ),
       (
              'P017',
              '../image/product/product17/product-detail-1.jpg ../image/product/product17/product-detail-2.jpg ',
              'Wide-leg pants',
              'NCC004',
              50,
              '- Quần âu nam ống côn sẽ giúp các chàng trông chuẩn soái ca.
              - Trong tủ có e này thì cực dễ phối đồ: sơmi, thun, vest đều đẹp
              - Chất Liệu: Vải lụa co giãn nhẹ, mềm mịn , Mỏng nhẹ
              - Giá Thành Tiết kiệm chi phí cho mình , sản phẩm dùng để mặc hằng ngày đi làm đi học',
              '1',
              'Black',
              'Male',
              24.99,
              15
       ),
       (
              'P018',
              '../image/product/product18/product-detail-1.jpg ../image/product/product18/product-detail-2.jpg ../image/product/product18/product-detail-3.jpg',
              'Heaven Handbag',
              'NCC004',
              50,
              'Style Hàn Quốc
              Thiết kế hiện đại trẻ trung, hợp xu hướng
              Chất liệu: Da PU
              - BẢO QUẢN:
              Dùng khăn ẩm lau sạch khi đi mưa, bụi bẩn bám
              Để nơi khô ráo thoáng mát tránh bị ẩm mốc',
              '1',
              'Light Yellow',
              'Female',
              33.99,
              0
       ),
       (
              'P019',
              '../image/product/product19/product-detail-1.jpg ../image/product/product19/product-detail-2.jpg ../image/product/product19/product-detail-3.jpg',
              'Laika Handbag',
              'NCC004',
              50,
              'Kích Thước: 13cm x 11cm x 6cm
              Phong Cách nữ tính, trẻ trung chuẩn Hàn Quốc.
              Chất liệu cao cấp chống thấm nước tốt. 

              Túi xách nữ xinh Túi chéo nữ mini phong cách Hàn Quốc Thiết kế kiểu dáng basic nhỏ gọn Túi Xinh LaiKa 
              Túi xách đeo chéo nữ kiểu dáng cực sang chảnh, thiết kế nhỏ gọn lên đồ cực xinh TDC047',
              '1',
              'Black',
              'Female',
              15.99,
              0
       );

-- check data table product
USE  website_sells_clothes_and_bags;
SELECT productCode,nameProduct
FROM product




-- data table HandbagProduct
USE  website_sells_clothes_and_bags;
INSERT INTO handbagproduct
       (productCode,bagMaterial,descriptionMaterial)
VALUES
       ('P018', 'skin', "Skin is a remarkable material, a testament to the intricate craftsmanship of nature itself. It serves as the protective barrier between the body and the outside world, offering resilience, flexibility, and sensitivity in equal measure. Composed of layers intricately woven together, skin is both durable and delicate, capable of withstanding the rigors of everyday life while also transmitting the gentlest of touches. At a closer glance, skin reveals a complex network of cells, fibers, and glands, each playing a crucial role in its function. The outermost layer, the epidermis, acts as a shield against harmful elements, while the dermis underneath provides structural support and houses an array of nerves, blood vessels, and sweat glands. Together, these layers form a dynamic system that regulates temperature, moisture, and sensation, adapting seamlessly to the body's needs."),
       ('P019', 'skin', "Skin is a remarkable material, a testament to the intricate craftsmanship of nature itself. It serves as the protective barrier between the body and the outside world, offering resilience, flexibility, and sensitivity in equal measure. Composed of layers intricately woven together, skin is both durable and delicate, capable of withstanding the rigors of everyday life while also transmitting the gentlest of touches. At a closer glance, skin reveals a complex network of cells, fibers, and glands, each playing a crucial role in its function. The outermost layer, the epidermis, acts as a shield against harmful elements, while the dermis underneath provides structural support and houses an array of nerves, blood vessels, and sweat glands. Together, these layers form a dynamic system that regulates temperature, moisture, and sensation, adapting seamlessly to the body's needs.");

-- check data table HandbagProduct
USE  website_sells_clothes_and_bags;
SELECT *
FROM handbagproduct

-- data table shirtproduct
USE  website_sells_clothes_and_bags;
INSERT INTO ShirtProduct
       (productCode, shirtMaterial, shirtStyle,descriptionMaterial)
VALUES
       ('P001', 'Cotton', 'Dress', 'Cotton is a remarkable material, cherished for its versatility and comfort. Derived from the fluffy fibers surrounding the seeds of the cotton plant, it is renowned for its softness and breathability. This natural fabric feels gentle against the skin, making it a favorite choice for clothing, bedding, and various textile products.'),
       
       ('P002', 'Fabric', 'Halter', "Fabric is a wondrous material, woven from threads of imagination and craftsmanship. Its texture tells stories of meticulous care and artistry. Each thread intertwines with another, creating a tapestry of possibilities. From the soft caress of silk to the rugged resilience of denim, fabric embodies versatility. In the gentle embrace of cotton, there's a whisper of comfort, a promise of warmth on a chilly day. Its fibers breathe life into clothing, making every movement effortless and every touch soothing. Linen, with its natural elegance, brings a sense of airy sophistication, draping gracefully with every fold."),

       ('P003', 'Cotton', 'Halter', "Cotton is a remarkable material, cherished for its versatility and comfort. Derived from the fluffy fibers surrounding the seeds of the cotton plant, it is renowned for its softness and breathability. This natural fabric feels gentle against the skin, making it a favorite choice for clothing, bedding, and various textile products."),

       ('P004', 'Fabric', 'Halter', "Fabric is a wondrous material, woven from threads of imagination and craftsmanship. Its texture tells stories of meticulous care and artistry. Each thread intertwines with another, creating a tapestry of possibilities. From the soft caress of silk to the rugged resilience of denim, fabric embodies versatility. In the gentle embrace of cotton, there's a whisper of comfort, a promise of warmth on a chilly day. Its fibers breathe life into clothing, making every movement effortless and every touch soothing. Linen, with its natural elegance, brings a sense of airy sophistication, draping gracefully with every fold."),
       ('P005', 'Cotton', 'T-shirt', "Cotton is a remarkable material, cherished for its versatility and comfort. Derived from the fluffy fibers surrounding the seeds of the cotton plant, it is renowned for its softness and breathability. This natural fabric feels gentle against the skin, making it a favorite choice for clothing, bedding, and various textile products."),
       ('P006', 'Cotton', 'T-shirt', "Cotton is a remarkable material, cherished for its versatility and comfort. Derived from the fluffy fibers surrounding the seeds of the cotton plant, it is renowned for its softness and breathability. This natural fabric feels gentle against the skin, making it a favorite choice for clothing, bedding, and various textile products."),
       ('P007', 'Polyester', 'T-shirt', "	Polyester is a versatile and widely used synthetic fabric renowned for its durability and resistance to wrinkles and shrinkage. Composed of long-chain polymers, it offers excellent strength and resilience, making it ideal for a multitude of applications. Its smooth texture provides a comfortable feel against the skin, while its lightweight nature ensures ease of wear. Polyester fabrics are often praised for their quick-drying properties, making them a popular choice for sportswear and outdoor gear. Additionally, polyester's ability to retain color vibrancy over time makes it a preferred option for vibrant and long-lasting garments. Whether in clothing, upholstery, or home furnishings, polyester continues to be valued for its reliability and adaptability across various industries."),
       ('P008', 'Polyester', 'T-shirt', "Polyester is a versatile and widely used synthetic fabric renowned for its durability and resistance to wrinkles and shrinkage. Composed of long-chain polymers, it offers excellent strength and resilience, making it ideal for a multitude of applications. Its smooth texture provides a comfortable feel against the skin, while its lightweight nature ensures ease of wear. Polyester fabrics are often praised for their quick-drying properties, making them a popular choice for sportswear and outdoor gear. Additionally, polyester's ability to retain color vibrancy over time makes it a preferred option for vibrant and long-lasting garments. Whether in clothing, upholstery, or home furnishings, polyester continues to be valued for its reliability and adaptability across various industries."),
       ('P009', 'Fabric', 'T-shirt', "Polyester is a versatile and widely used synthetic fabric renowned for its durability and resistance to wrinkles and shrinkage. Composed of long-chain polymers, it offers excellent strength and resilience, making it ideal for a multitude of applications. Its smooth texture provides a comfortable feel against the skin, while its lightweight nature ensures ease of wear. Polyester fabrics are often praised for their quick-drying properties, making them a popular choice for sportswear and outdoor gear. Additionally, polyester's ability to retain color vibrancy over time makes it a preferred option for vibrant and long-lasting garments. Whether in clothing, upholstery, or home furnishings, polyester continues to be valued for its reliability and adaptability across various industries."),
       ('P010', 'Polyester', 'T-shirt', "Polyester is a versatile and widely used synthetic fabric renowned for its durability and resistance to wrinkles and shrinkage. Composed of long-chain polymers, it offers excellent strength and resilience, making it ideal for a multitude of applications. Its smooth texture provides a comfortable feel against the skin, while its lightweight nature ensures ease of wear. Polyester fabrics are often praised for their quick-drying properties, making them a popular choice for sportswear and outdoor gear. Additionally, polyester's ability to retain color vibrancy over time makes it a preferred option for vibrant and long-lasting garments. Whether in clothing, upholstery, or home furnishings, polyester continues to be valued for its reliability and adaptability across various industries."),
       ('P011', 'Polyester', 'T-shirt', "Polyester is a versatile and widely used synthetic fabric renowned for its durability and resistance to wrinkles and shrinkage. Composed of long-chain polymers, it offers excellent strength and resilience, making it ideal for a multitude of applications. Its smooth texture provides a comfortable feel against the skin, while its lightweight nature ensures ease of wear. Polyester fabrics are often praised for their quick-drying properties, making them a popular choice for sportswear and outdoor gear. Additionally, polyester's ability to retain color vibrancy over time makes it a preferred option for vibrant and long-lasting garments. Whether in clothing, upholstery, or home furnishings, polyester continues to be valued for its reliability and adaptability across various industries."),
       ('P012', 'Polyester', 'T-shirt', "Polyester is a versatile and widely used synthetic fabric renowned for its durability and resistance to wrinkles and shrinkage. Composed of long-chain polymers, it offers excellent strength and resilience, making it ideal for a multitude of applications. Its smooth texture provides a comfortable feel against the skin, while its lightweight nature ensures ease of wear. Polyester fabrics are often praised for their quick-drying properties, making them a popular choice for sportswear and outdoor gear. Additionally, polyester's ability to retain color vibrancy over time makes it a preferred option for vibrant and long-lasting garments. Whether in clothing, upholstery, or home furnishings, polyester continues to be valued for its reliability and adaptability across various industries."),
       ('P013', 'Cotton', 'T-shirt', "Cotton is a remarkable material, cherished for its versatility and comfort. Derived from the fluffy fibers surrounding the seeds of the cotton plant, it is renowned for its softness and breathability. This natural fabric feels gentle against the skin, making it a favorite choice for clothing, bedding, and various textile products."),
       ('P014', 'Polyester', 'Polo', "Polyester is a versatile and widely used synthetic fabric renowned for its durability and resistance to wrinkles and shrinkage. Composed of long-chain polymers, it offers excellent strength and resilience, making it ideal for a multitude of applications. Its smooth texture provides a comfortable feel against the skin, while its lightweight nature ensures ease of wear. Polyester fabrics are often praised for their quick-drying properties, making them a popular choice for sportswear and outdoor gear. Additionally, polyester's ability to retain color vibrancy over time makes it a preferred option for vibrant and long-lasting garments. Whether in clothing, upholstery, or home furnishings, polyester continues to be valued for its reliability and adaptability across various industries"),
       ('P015', 'Cotton', 'Trouser', "Cotton is a remarkable material, cherished for its versatility and comfort. Derived from the fluffy fibers surrounding the seeds of the cotton plant, it is renowned for its softness and breathability. This natural fabric feels gentle against the skin, making it a favorite choice for clothing, bedding, and various textile products."),
       ('P016', 'Cotton', 'Polo', "Cotton is a remarkable material, cherished for its versatility and comfort. Derived from the fluffy fibers surrounding the seeds of the cotton plant, it is renowned for its softness and breathability. This natural fabric feels gentle against the skin, making it a favorite choice for clothing, bedding, and various textile products"),
       ('P017', 'Polyester', 'Trouser', "Polyester is a versatile and widely used synthetic fabric renowned for its durability and resistance to wrinkles and shrinkage. Composed of long-chain polymers, it offers excellent strength and resilience, making it ideal for a multitude of applications. Its smooth texture provides a comfortable feel against the skin, while its lightweight nature ensures ease of wear. Polyester fabrics are often praised for their quick-drying properties, making them a popular choice for sportswear and outdoor gear. Additionally, polyester's ability to retain color vibrancy over time makes it a preferred option for vibrant and long-lasting garments. Whether in clothing, upholstery, or home furnishings, polyester continues to be valued for its reliability and adaptability across various industries.");

-- check data table ShirtProduct
USE  website_sells_clothes_and_bags;
SELECT *
FROM ShirtProduct




-- data table comment
USE  website_sells_clothes_and_bags;
INSERT INTO Comment
       (codeComment,productCode, userNameComment, userNameRepComment, sentDate, content, state, likeNumber, dislikeNumber)
VALUES
       ('CM001', 'P001', 'Sm9obkRvZQ==', 'null', '2024-03-09', 'This is another comment.', '1', 8, 3),
       ('CM002', 'P001', 'SmFuZVNtaXRo', 'null', '2024-03-10', 'Yet another comment.', '1', 15, 7),
       ('CM003', 'P003', 'Sm9obkRvZQ==', 'null', '2024-03-11', 'One more comment.', '1', 12, 4),
       ('CM004', 'P003', 'RW1pbHlEYXZpcw==', 'null', '2024-03-12', 'Comment number five.', '1', 20, 10),
       ('CM005', 'P003', 'Qm9iQnJvd24=', 'null', '2024-03-13', 'This is a comment.', '1', 10, 5),
       ('CM006', 'P002', 'Sm9obkRvZQ==', 'null', '2024-03-14', 'This is a comment.', '1', 10, 5),
       ('CM007', 'P002', 'SmFuZVNtaXRo', 'null', '2024-03-15', 'This is a comment.', '1', 10, 5),
       ('CM008', 'P004', 'Sm9obkRvZQ==', 'null', '2024-03-16', 'This is a comment.', '1', 10, 5),
       ('CM009', 'P004', 'SmFuZVNtaXRo', 'null', '2024-03-17', 'This is a comment.', '1', 10, 5),
       ('CM010', 'P004', 'RW1pbHlEYXZpcw==', 'null', '2024-03-18', 'This is a comment.', '1', 10, 5),
       ('CM011', 'P004', 'Qm9iQnJvd24=', 'null', '2024-03-19', 'This is a comment.', '1', 10, 5),
       ('CM012', 'P005', 'Qm9iQnJvd24=', 'null', '2024-03-20', 'This is a comment.', '1', 10, 5);

-- check data table comment
USE  website_sells_clothes_and_bags;
SELECT *
FROM comment



-- data table feedback
USE  website_sells_clothes_and_bags;
INSERT INTO feedback
       (codeFeedback,userName, sentDate, email, content, replay)
VALUES
       ('FB001', 'QWxpY2VKb2huc29u', '2024-03-08', 'john@example.com', 'I really appreciate the service provided by your team. Keep up the good work!', 'Thank you'),
       ('FB002', 'QWxpY2VKb2huc29u', '2024-03-09', 'jane@example.com', 'I really appreciate the service provided by your team. Keep up the good work!', 'Thank you'),
       ('FB003', 'QWxpY2VKb2huc29u', '2024-03-10', 'alice@example.com', 'I really appreciate the service provided by your team. Keep up the good work!', 'Thank you'),
       ('FB004', 'QWxpY2VKb2huc29u', '2024-03-11', 'bob@example.com', 'I really appreciate the service provided by your team. Keep up the good work!', 'Thank you'),
       ('FB005', 'QWxpY2VKb2huc29u', '2024-03-12', 'emily@example.com', 'I really appreciate the service provided by your team. Keep up the good work!', 'Thank you');

-- check data table feedback
USE  website_sells_clothes_and_bags;
SELECT *
FROM feedback


-- data table payment
USE  website_sells_clothes_and_bags;
INSERT INTO payment
       (namePayment, codePayments, affiliatedBank)
VALUES
       ('PayPal', 'PP001', 'Bank of America'),
       ('Visa', 'VS002', 'Chase Bank'),
       ('MasterCard', 'MC003', 'Wells Fargo'),
       ('Apple Pay', 'AP004', 'Citi Bank');

-- check data table payment
USE  website_sells_clothes_and_bags;
SELECT *
FROM payment




-- data table transport
USE  website_sells_clothes_and_bags;
INSERT INTO Transport
       (nameTransport, codeTransport, affiliatedCompany)
VALUES
       ('Express Shipping', 'EXP001', 'DHL'),
       ('Standard Shipping', 'STD002', 'UPS'),
       ('Economy Shipping', 'ECO003', 'FedEx');

-- check data table transport
USE  website_sells_clothes_and_bags;
SELECT *
FROM transport


-- data table orders
USE  website_sells_clothes_and_bags;
INSERT INTO orders
       (orderCode,deliveryAddress, dateCreated, dateDelivery, dateFinish, userName, totalMoney, codePayments, codeTransport, status, note)
VALUES
       ('ORD001','1010 Pine St' ,'2024-03-01', '2024-03-05', '2024-03-06', 'UGh1Y0FwdVRydW9uZw==', 150.00, 'PP001', 'EXP001', 'processing', 'Please ensure timely delivery.'),

       ('ORD002', '1010 Pine St','2024-03-02', '2024-03-06', '2024-03-07', 'QWxpY2VKb2huc29u', 170.00, 'VS002', 'STD002', 'processing', 'Customer requested expedited shipping.'),
       
       ('ORD003', '1010 Pine St','2024-03-03', '2024-03-07', '2024-03-08', 'UGh1Y0FwdVRydW9uZw==', 70.00, 'MC003', 'EXP001', 'completed', 'Delivered to the customer successfully.');

-- check data table orders
USE  website_sells_clothes_and_bags;
SELECT *
FROM orders

-- data table orderDetail
USE  website_sells_clothes_and_bags;
INSERT INTO orderDetail
       (orderCode, productCode, nameProduct, priceProduct, quantity, sizeCode, totalMoney)
VALUES
       ('ORD001', 'P001', 'Jumpsuit quấn siêu mềm', 20.00, 17,'S001', 340.0),
       ('ORD001', 'P001', 'Jumpsuit quấn siêu mềm', 20.00, 18,'S002', 360.00),
       ('ORD001', 'P001', 'Jumpsuit quấn siêu mềm', 20.00, 15,'S003', 300.00),

       ('ORD001', 'P002', 'JDenim playsuit', 20.00, 16,'S001', 16*20.00),
       ('ORD001', 'P002', 'JDenim playsuit', 20.00, 17,'S002', 17*20.00),
       ('ORD001', 'P002', 'JDenim playsuit', 20.00, 17,'S003', 17*20.00),

       ('ORD001', 'P003', 'Halterneck jumpsuit', 20.00, 18,'S001', 18*20.00),
       ('ORD001', 'P003', 'Halterneck jumpsuit', 20.00, 16,'S002', 16*20.00),
       ('ORD001', 'P003', 'Halterneck jumpsuit', 20.00, 18,'S003', 18*20.00),

       ('ORD001', 'P004', 'Denim jumpsuit', 20.00, 19,'S001', 19*20.00),
       ('ORD001', 'P004', 'Denim jumpsuit', 20.00, 15,'S002', 15*20.00),
       ('ORD001', 'P004', 'Denim jumpsuit', 20.00, 16,'S003', 16*20.00),

       ('ORD001', 'P005', 'Linen T-Shirt', 20.00, 18,'S001', 18*20.00),
       ('ORD001', 'P005', 'Linen T-Shirt', 20.00, 17,'S002', 17*20.00),
       ('ORD001', 'P005', 'Linen T-Shirt', 20.00, 18,'S003', 15*20.00),

       ('ORD001', 'P006', 'Oversized printed T-shirt', 20.00, 19,'S001', 19*20.00),
       ('ORD001', 'P006', 'Oversized printed T-shirt', 20.00, 16,'S002', 16*20.00),
       ('ORD001', 'P006', 'Oversized printed T-shirt', 20.00, 15,'S003', 15*20.00),

       ('ORD001', 'P007', 'Printed T-shirt', 20.00, 17,'S001', 17*20.00),
       ('ORD001', 'P007', 'Printed T-shirt', 20.00, 18,'S002', 18*20.00),
       ('ORD001', 'P007', 'Printed T-shirt', 20.00, 15,'S003', 15*20.00),

       ('ORD001', 'P008', 'Cotton T-Shirt', 20.00, 16,'S001', 16*20.00),
       ('ORD001', 'P008', 'Cotton T-Shirt', 20.00, 17,'S002', 17*20.00),
       ('ORD001', 'P008', 'Cotton T-Shirt', 20.00, 17,'S003', 17*20.00),

       ('ORD001', 'P009', 'Oversized crinkled shirt', 20.00, 18,'S001', 18*20.00),
       ('ORD001', 'P009', 'Oversized crinkled shirt', 20.00, 16,'S002', 16*20.00),
       ('ORD001', 'P009', 'Oversized crinkled shirt', 20.00, 16,'S003', 16*20.00),

       ('ORD001', 'P010', 'Linen-blend pop-over shirt', 20.00, 19,'S001', 19*20.00),
       ('ORD001', 'P010', 'Linen-blend pop-over shirt', 20.00, 15,'S002', 15*20.00),
       ('ORD001', 'P010', 'Linen-blend pop-over shirt', 20.00, 16,'S003', 16*20.00),

       ('ORD001', 'P011', 'V-neck blouse', 20.00, 18,'S001', 18*20.00),
       ('ORD001', 'P011', 'V-neck blouse', 20.00, 17,'S002', 17*20.00),
       ('ORD001', 'P011', 'V-neck blouse', 20.00, 15,'S003', 15*20.00),

       ('ORD001', 'P012', 'Oxford shirt', 20.00, 19,'S001', 19*20.00),
       ('ORD001', 'P012', 'Oxford shirt', 20.00, 16,'S002', 16*20.00),
       ('ORD001', 'P012', 'Oxford shirt', 20.00, 15,'S003', 15*20.00),

       ('ORD001', 'P013', 'Women’s Double Gauze Long Sleeve Button Down Shirt', 20.00, 17,'S001', 17*20.00),
       ('ORD001', 'P013', 'Women’s Double Gauze Long Sleeve Button Down Shirt', 20.00, 18,'S002', 18*20.00),
       ('ORD001', 'P013', 'Women’s Double Gauze Long Sleeve Button Down Shirt', 20.00, 15,'S003', 15*20.00),

       ('ORD001', 'P014', 'Poloman Shirt', 20.00, 16,'S001', 16*20.00),
       ('ORD001', 'P014', 'Poloman Shirt', 20.00, 17,'S002', 17*20.00),
       ('ORD001', 'P014', 'Poloman Shirt', 20.00, 17,'S003', 17*20.00),

       ('ORD001', 'P015', 'Trouser Man', 20.00, 18,'S001', 18*20.00),
       ('ORD001', 'P015', 'Trouser Man', 20.00, 16,'S002', 16*20.00),
       ('ORD001', 'P015', 'Trouser Man', 20.00, 16,'S003', 16*20.00),

       ('ORD001', 'P016', 'Short Denim', 20.00, 19,'S001', 19*20.00),
       ('ORD001', 'P016', 'Short Denim', 20.00, 15,'S002', 15*20.00),
       ('ORD001', 'P016', 'Short Denim', 20.00, 16,'S003', 16*20.00),

       ('ORD001', 'P017', 'Wide-leg pants', 20.00, 18,'S001', 18*20.00),
       ('ORD001', 'P017', 'Wide-leg pants', 20.00, 17,'S002', 17*20.00),
       ('ORD001', 'P017', 'Wide-leg pants', 20.00, 15,'S003', 15*20.00),

       ('ORD002', 'P018', 'Heaven Handbag', 20.00, 50,'null', 50*20.00),

       ('ORD003', 'P019', 'Laika Handbag', 20.00, 50,'null', 50*20.00);

       
       
       

-- check data table orderDetail
USE  website_sells_clothes_and_bags;
SELECT *
FROM orderDetail

-- data table size
USE  website_sells_clothes_and_bags;
INSERT INTO size
       (sizeCode, sizeName)
VALUES
       ('S001', 'Small'),
       ('S002', 'Medium'),
       ('S003', 'Large');

-- check data table size
USE  website_sells_clothes_and_bags;
SELECT *
FROM size

-- data ShirtSize
USE  website_sells_clothes_and_bags;
INSERT INTO ShirtSize
       (productCode, sizeCode, quantity)
VALUES
       ('P001', 'S001', 17),
       ('P001', 'S002', 18),
       ('P001', 'S003', 15),
       ('P002', 'S001', 16),
       ('P002', 'S002', 17),
       ('P002', 'S003', 17),
       ('P003', 'S001', 18),
       ('P003', 'S002', 16),
       ('P003', 'S003', 16),
       ('P004', 'S001', 19),
       ('P004', 'S002', 15),
       ('P004', 'S003', 16),
       ('P005', 'S001', 18),
       ('P005', 'S002', 17),
       ('P005', 'S003', 15),
       ('P006', 'S001', 19),
       ('P006', 'S002', 16),
       ('P006', 'S003', 15),
       ('P007', 'S001', 17),
       ('P007', 'S002', 18),
       ('P007', 'S003', 15),
       ('P008', 'S001', 16),
       ('P008', 'S002', 17),
       ('P008', 'S003', 17),
       ('P009', 'S001', 18),
       ('P009', 'S002', 16),
       ('P009', 'S003', 16),
       ('P010', 'S001', 19),
       ('P010', 'S002', 15),
       ('P010', 'S003', 16),
       ('P011', 'S001', 18),
       ('P011', 'S002', 17),
       ('P011', 'S003', 15),
       ('P012', 'S001', 19),
       ('P012', 'S002', 16),
       ('P012', 'S003', 15),
       ('P013', 'S001', 17),
       ('P013', 'S002', 18),
       ('P013', 'S003', 15),
       ('P014', 'S001', 16),
       ('P014', 'S002', 17),
       ('P014', 'S003', 17),
       ('P015', 'S001', 18),
       ('P015', 'S002', 16),
       ('P015', 'S003', 16),
       ('P016', 'S001', 19),
       ('P016', 'S002', 15),
       ('P016', 'S003', 16),
       ('P017', 'S001', 18),
       ('P017', 'S002', 17),
       ('P017', 'S003', 15);

-- check data table ShirtSize
USE  website_sells_clothes_and_bags;
SELECT *
FROM ShirtSize














       -- ('PhucApuTruong', '123456', '2024-03-14', 'active', 'Trương Công Phúc', '123 Main St', 'truongphuc056@gmail.com', '0823072871', '2003-06-10', 'Male', 'admin'),
       -- ('FatnotPhat', '123456', '2024-03-14', 'active', 'Trần Tiến Phát', '123 Main St', 'Fat@gmail.com', '0823072871', '2003-01-01', 'Male', 'admin'),
       -- ('JohnDoe', 'password123', '2024-03-15', 'active', 'John Doe', '456 Elm St', 'john@example.com', '0823072871', '1990-05-20', 'Male', 'user'),
       -- ('JaneSmith', 'qwerty', '2024-03-15', 'active', 'Jane Smith', '789 Oak St', 'jane@example.com', '0823072871', '1985-08-10', 'Female', 'user'),
       -- ('AliceJohnson', 'abcdef', '2024-03-16', 'active', 'Alice Johnson', '1010 Pine St', 'alice@example.com', '0823072871', '1995-02-15', 'Female', 'user'),
       -- ('BobBrown', 'hello123', '2024-03-16', 'active', 'Bob Brown', '1212 Maple St', 'bob@example.com', '0823072871', '1988-11-25', 'Male', 'user'),
       -- ('EmilyDavis', 'ilovecats', '2024-03-17', 'active', 'Emily Davis', '1414 Cedar St', 'emily@example.com', '0823072871', '1992-04-30', 'Female', 'user')


-- data table filter
USE  website_sells_clothes_and_bags;
INSERT INTO filter
       (filterParent, filterChild)
VALUES
       ('supplierCode', 'Gucci store branch 2'),
       ('supplierCode', 'Nike store branch SaiGon'),
       ('supplierCode', 'Adidas store branch SaiGon'),
       ('supplierCode', 'Chanel store branch LongAn'),
       ('EB003', 'P003');


-- text filter


-- lọc sản phẩm theo sản phẩm được mua nhiều (bán chạy nhất) nhất
-- Input: các bảng (product, orderdetail)
-- Output: mảng chứa mã sản phẩm được sắp xếp theo số lượng được mua nhiều nhất trong chi tiết đơn hàng  
-- kiểm tra:
USE  website_sells_clothes_and_bags;
SELECT pr.productCode, pr.nameProduct , SUM(odt.quantity) AS NumberOfBuying
FROM product pr, orderdetail odt
WHERE pr.productCode = odt.productCode
GROUP BY pr.productCode
ORDER BY NumberOfBuying DESC





-- lọc sản phẩm đang được giảm giá nhiều nhất
-- Input: bảng (product)
-- Output: mảng chứa mã sản phẩm sắp xếp giảm dần từ giảm giá cao nhất đến thấp nhất.
-- Kiểm tra:
USE  website_sells_clothes_and_bags;
SELECT pr.productCode, pr.promotion
FROM product pr
ORDER BY pr.promotion DESC 

-- lọc sản phẩm dựa theo giá từ thấp đến cao
-- Input: bảng (product)
-- Output: mảng sản phẩm có giá từ thấp đến đến cao
-- Kiểm tra:
USE  website_sells_clothes_and_bags;
SELECT pr.productCode, pr.price
FROM product pr
ORDER BY pr.price ASC

USE  website_sells_clothes_and_bags;
SELECT pr.productCode, pr.price
FROM product pr
ORDER BY pr.price DESC      

-- lọc sản phẩm dựa theo giá từ khoảng A đến khoảng B
-- Input: bảng (product) và 2 giá trị A,B
-- Output: mảng sản phẩm có giá từ A đến B và sắp xếp giá nó từ thấp đến cao
-- Kiểm tra:
USE  website_sells_clothes_and_bags;
SELECT pr.productCode, pr.price
FROM product pr
WHERE pr.price BETWEEN 0 AND 30   
ORDER BY pr.price
---------------- Lấy giá trị price max
USE  website_sells_clothes_and_bags;
SELECT MAX(pr.price) as priceMax
FROM product pr


-- lọc sản phẩm theo đối tượng sử dụng 
-- Input: bảng(product) và đối tượng sử dụng
-- Output: mảng chứa sản phẩm được dùng cho đối tượng được truyền vào.
-- Kiểm tra:
USE  website_sells_clothes_and_bags;
SELECT pr.productCode, pr.targetGender
FROM product pr
WHERE pr.targetGender = 'male'

USE  website_sells_clothes_and_bags;
SELECT pr.productCode, pr.targetGender
FROM product pr
WHERE pr.targetGender = 'female'

------ Lấy danh sách các đối tượng sử dụng sản phẩm
USE  website_sells_clothes_and_bags;
SELECT pr.targetGender
FROM product pr
GROUP BY pr.targetGender

-- lọc sản phẩm dựa theo màu sắc
-- Input: bảng(product) và màu sắc
-- Output: mảng chứa sản phẩm có màu sắc được truyền vào.
-- Kiểm tra:
USE  website_sells_clothes_and_bags;
SELECT pr.productCode, pr.color
FROM product pr
WHERE pr.color = 'blue'

------ Lấy danh sách màu sắc có trong sản phẩm
USE  website_sells_clothes_and_bags;
SELECT pr.color
FROM product pr
GROUP BY pr.color


-- lọc sản phẩm túi sách dựa theo chất liệu túi
-- Input: bảng (product, handbagproduct) và chất liệu
-- Output: mảng chứa sản phẩm túi có chất liệu giống giá trị truyền vào
USE  website_sells_clothes_and_bags;
SELECT pr.productCode, hbpd.bagMaterial
FROM product pr, handbagproduct hbpd
WHERE pr.productCode = hbpd.productCode AND hbpd.bagMaterial = 'skin'
---------- Lấy danh sách chất liệu sản phẩm túi
USE  website_sells_clothes_and_bags;
SELECT hbpd.bagMaterial
FROM handbagproduct hbpd
GROUP BY hbpd.bagMaterial

-- lọc sản phẩm áo dựa theo chất liệu được truyền vào
-- Input: bange (product, shirtproduct) và chất liệu
-- Output: mảng chứa sản phẩm túi có chất liệu giống giá trị truyền vào
USE  website_sells_clothes_and_bags;
SELECT pr.productCode, sp.shirtMaterial
FROM product pr, shirtproduct sp
WHERE pr.productCode = sp.productCode AND sp.shirtMaterial = 'Cotton'

------------ Lấy danh sách chất liệu áo được truyền vào
USE  website_sells_clothes_and_bags;
SELECT sp.shirtMaterial
FROM shirtproduct sp
GROUP BY sp.shirtMaterial

-- lọc sản phẩm áo dựa theo style được truyền vào
-- Input: bange (product, shirtproduct) và style áo
-- Output: mảng chứa sản phẩm túi có style giống giá trị truyền vào
USE  website_sells_clothes_and_bags;
SELECT pr.productCode, sp.shirtStyle
FROM product pr, shirtproduct sp
WHERE pr.productCode = sp.productCode AND sp.shirtStyle = 'Polo'

-------------- Lấy danh sách style áo được truyền vào
USE  website_sells_clothes_and_bags;
SELECT sp.shirtStyle
FROM shirtproduct sp
GROUP BY sp.shirtStyle


-- Lấy danh sách mã productCode
USE  website_sells_clothes_and_bags;
SELECT pr.productCode
FROM product pr




--- Thống kê các số sản phẩm bán được trong khoảng thời gian từ A đến B
-- input: bảng chi tiết háo đơn, bản sản phẩm
USE  website_sells_clothes_and_bags;
SELECT pr.productCode, pr.imgProduct ,pr.price, pr.nameProduct, pr.quantity as quantityStore, SUM(oddt.quantity) as quantityBuy
FROM product pr , orderdetail oddt , orders od
WHERE pr.productCode = oddt.productCode AND od.orderCode = oddt.orderCode AND od.dateCreated BETWEEN '2000-01-01' AND '2024-05-06'
GROUP BY pr.productCode


--- Thống kê các số sản phẩm túi bán được trong khoảng thời gian từ A đến B
-- input: bảng chi tiết háo đơn, bản sản phẩm
USE  website_sells_clothes_and_bags;
SELECT pr.productCode , pr.imgProduct ,pr.price, pr.nameProduct, pr.quantity as quantityStore, SUM(oddt.quantity) as quantityBuy
FROM product pr ,handbagproduct hbpr , orderdetail oddt , orders od
WHERE pr.productCode = oddt.productCode AND hbpr.productCode = pr.productCode AND od.orderCode = oddt.orderCode AND od.dateCreated BETWEEN '2024-05-05' AND '2024-05-06'
GROUP BY pr.productCode


--- Thống kê các số sản phẩm áo bán được trong khoảng thời gian từ A đến B
-- input: bảng chi tiết háo đơn, bản sản phẩm
USE  website_sells_clothes_and_bags;
SELECT pr.productCode , pr.imgProduct,pr.price, pr.nameProduct, pr.quantity as quantityStore, SUM(oddt.quantity) as quantityBuy
FROM product pr ,shirtproduct shpr , orderdetail oddt, orders od
WHERE pr.productCode = oddt.productCode AND shpr.productCode = pr.productCode AND od.orderCode = oddt.orderCode AND od.dateCreated BETWEEN '2024-05-05' AND '2024-05-06'
GROUP BY pr.productCode


-- 
USE  website_sells_clothes_and_bags;
SELECT * FROM orders od  WHERE od.dateCreated  BETWEEN '2024-05-05' AND '2024-05-06'


USE  website_sells_clothes_and_bags;
SELECT * FROM permissionsDetail WHERE codePermissions = 'user'


























DELIMITER $$

CREATE PROCEDURE usp_get_account(IN p_userName VARCHAR(255))
BEGIN
    DECLARE v_userName VARCHAR(255);
    DECLARE v_passWord VARCHAR(255);
    DECLARE v_dateCreated DATETIME;
    DECLARE v_accountStatus INT;
    DECLARE v_name VARCHAR(255);
    DECLARE v_address VARCHAR(255);
    DECLARE v_email VARCHAR(255);
    DECLARE v_phoneNumber VARCHAR(15);
    DECLARE v_birth DATE;
    DECLARE v_sex CHAR(1);
    DECLARE v_codePermission INT;

    -- Tạo câu truy vấn dễ bị tấn công
    SET @sql = CONCAT('SELECT userName, passWord, dateCreated, accountStatus, name, address, email, phoneNumber, birth, sex, codePermissions ',
                      'FROM accounts WHERE userName = ''', p_userName, '''');

    -- Thực thi câu truy vấn
    PREPARE stmt FROM @sql;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;

    -- Lưu thông tin vào các biến để trả về
    -- Cách này không còn cần thiết vì chúng ta đã thực thi câu truy vấn và không còn sử dụng các biến
END$$

DELIMITER ;



DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_get_account`(IN p_userName VARCHAR(255), IN p_passWord VARCHAR(255))
BEGIN
    DECLARE v_userName VARCHAR(255);
    DECLARE v_passWord VARCHAR(255);
    DECLARE v_dateCreated DATETIME;
    DECLARE v_accountStatus INT;
    DECLARE v_name VARCHAR(255);
    DECLARE v_address VARCHAR(255);
    DECLARE v_email VARCHAR(255);
    DECLARE v_phoneNumber VARCHAR(15);
    DECLARE v_birth DATE;
    DECLARE v_sex CHAR(1);
    DECLARE v_codePermission INT;

    -- Tạo câu truy vấn dễ bị tấn công
    SET @sql = CONCAT('SELECT userName, passWord, dateCreated, accountStatus, name, address, email, phoneNumber, birth, sex, codePermissions ',
                      'FROM accounts WHERE userName = ''', p_userName, ''' AND passWord = ''', p_passWord, '''');

    -- Thực thi câu truy vấn
    PREPARE stmt FROM @sql;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;

    -- Lưu thông tin vào các biến để trả về
    -- Cách này không còn cần thiết vì chúng ta đã thực thi câu truy vấn và không còn sử dụng các biến
END$$
DELIMITER ;






DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_get_account_procedure`(IN `p_userName` VARCHAR(255), IN `p_passWord` VARCHAR(255))
BEGIN 
    -- Tạo câu truy vấn dễ bị tấn công
    SET @sql = CONCAT('SELECT userName, passWord ',
                      'FROM accounts WHERE userName = ''', p_userName, ''' AND passWord = ''', p_passWord, '''');

    -- In ra câu truy vấn để xem
    SELECT @sql AS query;

    -- Thực thi câu truy vấn
    PREPARE stmt FROM @sql;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;

    -- Lưu thông tin vào các biến (không cần thiết nhưng vẫn có thể làm nếu cần)
END$$
DELIMITER ;






DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `use_procedure_sql_protected`(
    IN `p_userName` VARCHAR(255), 
    IN `p_passWord` VARCHAR(255)
)
BEGIN
    -- Truy vấn dữ liệu và trả về kết quả trực tiếp
    SELECT userName, passWord
    FROM accounts
    WHERE userName = p_userName AND passWord = p_passWord;
END$$
DELIMITER ;


-- use_procedure_sql_injection
DELIMITER $$
CREATE PROCEDURE use_procedure_sql_injection(IN p_userName VARCHAR(255), IN p_passWord VARCHAR(255))
BEGIN
    -- Thực hiện truy vấn trực tiếp để kiểm tra
    SELECT * FROM accounts WHERE userName = p_userName AND passWord = p_passWord;
    
    -- Tiếp tục với phần còn lại của thủ tục như trước
    SET @sql = CONCAT('SELECT * FROM accounts WHERE userName = ''', p_userName, ''' AND passWord = ''', p_passWord, '''');
    PREPARE stmt FROM @sql;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
END$$
DELIMITER ;



-- attack_sql_cn
-- take all accounts
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `attack_sql_cn`(IN `p_userName` VARCHAR(255), IN `p_passWord` VARCHAR(255))
BEGIN 
	-- Thay thế các dấu ' thành '' (escape)
    -- SET p_userName = REPLACE(p_userName, "'", "''");
    -- SET p_passWord = REPLACE(p_passWord, "'", "''");
    
    -- Tạo câu truy vấn dễ bị tấn công (không dùng PREPARE)
    SET @sql = CONCAT('SELECT * FROM accounts WHERE userName = ''', p_userName, ''' AND passWord = ''', p_passWord, '''');
    
    -- In ra câu truy vấn để xem (dùng cho mục đích debug)
     -- SELECT @sql AS query;
  	-- Tắt các chế độ bảo mật của SQL để dễ demo tấn công
    SET SESSION sql_mode = '';
    EXECUTE IMMEDIATE @sql;
	-- Thực thi câu truy vấn trực tiếp bằng cách sử dụng SELECT
    -- Điều này sẽ trả về kết quả mà không cần PREPARE
    SET @result = (SELECT * FROM accounts WHERE userName = p_userName AND passWord = p_passWord);
    -- Trả về kết quả
    SELECT * FROM accounts WHERE userName = p_userName AND passWord = p_passWord;
    -- Thực thi câu truy vấn
    -- PREPARE stmt FROM @sql;
    -- EXECUTE stmt;
    
    -- Trả về kết quả
    -- DEALLOCATE PREPARE stmt;
END$$
DELIMITER ;




-- use_procedure_sql_injection_end
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `use_procedure_sql_injection_end`(IN `p_userName` VARCHAR(255), IN `p_passWord` VARCHAR(255))
BEGIN 
    -- Tạo câu truy vấn dễ bị tấn công (không dùng PREPARE)
    SET @sql = CONCAT('SELECT * FROM accounts WHERE userName = ''', p_userName, ''' AND passWord = ''', p_passWord, '''');
    
    -- In ra câu truy vấn để xem (dùng cho mục đích debug)
    SELECT @sql AS query;

    -- Tắt các chế độ bảo mật của SQL để dễ demo tấn công
    SET SESSION sql_mode = '';  
    
    -- Thực thi trực tiếp câu truy vấn mà không cần PREPARE
    SET @result = NULL;
    SET @result = (SELECT * FROM accounts WHERE userName = p_userName AND passWord = p_passWord);
    
    -- Trả về kết quả
    SELECT * FROM accounts WHERE userName = p_userName AND passWord = p_passWord;
END$$
DELIMITER ;


-- use_procedure_sql_injection_mix
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `use_procedure_sql_injection_mix`(IN `p_userName` VARCHAR(255), IN `p_passWord` VARCHAR(255))
BEGIN 
	-- Thay thế các dấu ' thành '' (escape)
    SET p_userName = REPLACE(p_userName, "'", "''");
    SET p_passWord = REPLACE(p_passWord, "'", "''");
    
	-- Thực hiện truy vấn trực tiếp để kiểm tra
    SELECT * FROM accounts WHERE userName = p_userName AND passWord = p_passWord;
    
    -- Tạo câu truy vấn dễ bị tấn công
    -- SET @sql = CONCAT('SELECT * ','FROM accounts WHERE userName = ''', p_userName, ''' AND passWord = ''', p_passWord, '''');
	-- SET @sql = CONCAT("SELECT * FROM accounts WHERE userName = ', p_userName, ' AND passWord = ', p_passWord, '");
    -- SET @sql = CONCAT("SELECT * FROM accounts WHERE userName = '", p_userName, "' AND passWord = '", p_passWord, "'");
    SET @sql = CONCAT('SELECT * FROM accounts WHERE userName = "', p_userName, '" AND passWord = "', p_passWord, '"');
	-- SET @sql = CONCAT('SELECT * FROM accounts WHERE userName = ''', p_userName, ''' AND passWord = ''', p_passWord, '''');
	-- For debugging, log the query
    INSERT INTO log_queries (query_text) VALUES (@sql);
    
    -- In ra câu truy vấn để xem
    SELECT @sql AS query;

    -- Thực thi câu truy vấn
    PREPARE stmt FROM @sql;
    EXECUTE stmt;
    
    -- Trả về kết quả
    DEALLOCATE PREPARE stmt;
END$$
DELIMITER ;






-- hacker success 
-- Đặt DELIMITER để phân tách các lệnh SQL trong stored procedure
DELIMITER $$
-- Tạo stored procedure với tên là attack_sql_logically_incorrect
-- Được định nghĩa bởi người dùng root tại localhost
CREATE DEFINER=`root`@`localhost` PROCEDURE `attack_sql_logically_incorrect`(
    IN `p_userName` VARCHAR(255),  -- Tham số đầu vào p_userName kiểu VARCHAR
    IN `p_passWord` VARCHAR(255)   -- Tham số đầu vào p_passWord kiểu VARCHAR
)
BEGIN
    -- Tạo câu truy vấn dễ bị tấn công
    SET @sql = CONCAT(
        'SELECT * FROM accounts WHERE userName = ''', 
        p_userName, 
        ''' AND passWord = ''', 
        p_passWord, 
        ''''
    );
    -- Thực thi câu truy vấn
    SET SESSION sql_mode = '';  -- Tắt các chế độ bảo mật của SQL để dễ demo tấn công
    PREPARE stmt FROM @sql;     -- Chuẩn bị câu lệnh SQL từ biến @sql
    EXECUTE stmt;               -- Thực thi câu lệnh đã chuẩn bị
    -- Giải phóng câu lệnh đã chuẩn bị
    DEALLOCATE PREPARE stmt;    -- Giải phóng tài nguyên của câu lệnh đã chuẩn bị để tránh rò rỉ bộ nhớ
END$$
-- Khôi phục DELIMITER về trạng thái mặc định
DELIMITER ;


