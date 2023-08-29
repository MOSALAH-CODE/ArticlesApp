-- Create Users Table
CREATE TABLE Users
(
    user_id         INT AUTO_INCREMENT PRIMARY KEY,
    username        VARCHAR(50)  NOT NULL,
    email           VARCHAR(100) NOT NULL,
    password        VARCHAR(255) NOT NULL,
    profile_picture VARCHAR(255),
    created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create Articles Table
CREATE TABLE Articles
(
    article_id       INT AUTO_INCREMENT PRIMARY KEY,
    title            VARCHAR(255) NOT NULL,
    content          TEXT         NOT NULL,
    author_id        INT          NOT NULL,
    publication_date DATE         NOT NULL,
    image_url        VARCHAR(255),
    FOREIGN KEY (author_id) REFERENCES Users (user_id)
);

-- Create Categories Table
CREATE TABLE Categories
(
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(50) NOT NULL,
    description TEXT
);

-- Create ArticleCategories Table (Many-to-Many Relationship)
CREATE TABLE ArticleCategories
(
    article_id  INT,
    category_id INT,
    FOREIGN KEY (article_id) REFERENCES Articles (article_id),
    FOREIGN KEY (category_id) REFERENCES Categories (category_id),
    PRIMARY KEY (article_id, category_id)
);


CREATE TABLE remember_tokens
(
    id         int AUTO_INCREMENT PRIMARY KEY,
    user_id    int          NOT NULL,
    token      VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
);
