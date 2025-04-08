CREATE TABLE leads (
	id_leads int NOT NULL AUTO_INCREMENT,
    tanggal date,
    id_sales int,
    id_produk int,
    no_wa varchar(15),
    nama_lead varchar(255),
    kota varchar(255),
    PRIMARY KEY (id_leads)
);

CREATE TABLE produk (
	id_produk int NOT NULL AUTO_INCREMENT,
    nama_produk varchar(255),
    PRIMARY KEY (id_produk)
);

CREATE TABLE sales (
	id_sales int NOT NULL AUTO_INCREMENT,
    nama_sales varchar(255),
    PRIMARY KEY (id_sales)
);