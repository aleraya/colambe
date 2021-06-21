CREATE TABLE picture (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    url VARCHAR(255) NOT NULL,
    description VARCHAR(255),
    PRIMARY KEY (id)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

CREATE TABLE service (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL,
    summary VARCHAR(255),
    picture_id INT UNSIGNED,
    order_nb INT UNSIGNED,
    card_title VARCHAR(255),
    card_type VARCHAR(255),
    PRIMARY KEY (id),
    CONSTRAINT fk_picture_service
        FOREIGN KEY (picture_id)
        REFERENCES picture (id)
        ON DELETE SET NULL
        ON UPDATE RESTRICT
)  ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

CREATE TABLE paragraph (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    order_nb INT UNSIGNED NOT NULL,
    service_id INT UNSIGNED NOT NULL,
    PRIMARY KEY (id),
    CONSTRAINT fk_service_paragraph
        FOREIGN KEY (service_id)
        REFERENCES service (id)
        ON DELETE CASCADE
        ON UPDATE RESTRICT
)  ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

CREATE TABLE cardElement (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    content VARCHAR(255) NOT NULL,
    order_nb INT UNSIGNED NOT NULL,
    service_id INT UNSIGNED NOT NULL,
    PRIMARY KEY (id),
    CONSTRAINT fk_service_cardElement
        FOREIGN KEY (service_id)
        REFERENCES service (id)
        ON DELETE CASCADE
        ON UPDATE RESTRICT
)  ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

CREATE TABLE menu (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    root VARCHAR(255),
    slug VARCHAR(255),
    level INT UNSIGNED NOT NULL,
    order_nb INT UNSIGNED NOT NULL,
    service_id INT UNSIGNED,
    parent_menu_id INT UNSIGNED,
    PRIMARY KEY (id),
    CONSTRAINT fk_service_menu
        FOREIGN KEY (service_id)
        REFERENCES service (id)
        ON DELETE CASCADE
        ON UPDATE RESTRICT,
    CONSTRAINT fk_parent_menu
        FOREIGN KEY (parent_menu_id)
        REFERENCES menu (id)
        ON DELETE RESTRICT
        ON UPDATE RESTRICT
)  ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

CREATE TABLE event (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    date VARCHAR(255) NOT NULL,
    place VARCHAR(255) NOT NULL,
    fb_url VARCHAR(255),
    picture_id INT UNSIGNED,
    order_nb INT UNSIGNED,
    PRIMARY KEY (id),
    CONSTRAINT fk_picture_event
        FOREIGN KEY (picture_id)
        REFERENCES picture (id)
        ON DELETE SET NULL
        ON UPDATE RESTRICT
)  ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;


CREATE TABLE user (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE (username)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

CREATE TABLE config (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    value VARCHAR(255) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE (name)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

CREATE TABLE slot (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    day INT UNSIGNED NOT NULL,
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,
    PRIMARY KEY (id)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

CREATE TABLE priceCategory (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    order_nb INT UNSIGNED NOT NULL,
    PRIMARY KEY (id),
    UNIQUE (name)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

CREATE TABLE priceType (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(1) NOT NULL,
    PRIMARY KEY (id)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;


CREATE TABLE price (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    priceCategory_id INT UNSIGNED,
    name VARCHAR(255) NOT NULL,
    text VARCHAR(255) NOT NULL,
    price INT,
    priceType_id INT UNSIGNED,
    PRIMARY KEY (id),
    CONSTRAINT fk_priceCategory_price
        FOREIGN KEY (priceCategory_id)
        REFERENCES priceCategory (id)
        ON DELETE SET NULL
        ON UPDATE RESTRICT,
    CONSTRAINT fk_priceType_price
        FOREIGN KEY (priceType_id)
        REFERENCES priceType (id)
        ON DELETE RESTRICT
        ON UPDATE RESTRICT
)  ENGINE=InnoDB DEFAULT CHARSET=utf8  COLLATE utf8_general_ci;