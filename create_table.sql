create table users(
	id		serial,
	login_name		varchar UNIQUE NOT NULL,
	pwd		varchar NOT NULL,
	PRIMARY KEY (id)
);

create table cats(
	id		serial,
	name		varchar UNIQUE NOT NULL,
	rsvd_cnt	int,
	img		varchar,
	PRIMARY KEY(id)
);

create table reserved(
	u_id		int,
	c_id		int,
	date_rsv	date	
);

insert into cats (name, rsvd_cnt, img) values('あかね', 8, './cimages/akane.png'); 
insert into cats (name, rsvd_cnt, img) values('あんず', 5, './cimages/anzu.png'); 
insert into cats (name, rsvd_cnt, img) values('あすな', 3, './cimages/asuna.png'); 
insert into cats (name, rsvd_cnt, img) values('えりか', 12, './cimages/erika.png'); 
insert into cats (name, rsvd_cnt, img) values('いぶき', 5, './cimages/ibuki.png'); 
insert into cats (name, rsvd_cnt, img) values('かんな', 4, './cimages/kanna.png'); 
insert into cats (name, rsvd_cnt, img) values('かりん', 8, './cimages/karin.png'); 
insert into cats (name, rsvd_cnt, img) values('かすみ', 7, './cimages/kasumi.png'); 
insert into cats (name, rsvd_cnt, img) values('みかん', 9, './cimages/mikan.png'); 
insert into cats (name, rsvd_cnt, img) values('なつめ', 6, './cimages/natsume.png'); 
 
