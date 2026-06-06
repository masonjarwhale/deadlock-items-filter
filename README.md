The 4 tables in the DB are formatted as follows:
```sql
CREATE TABLE tags (
    id INT(2),
    file_name VARCHAR(30),
    display_name VARCHAR(30),
    filepath VARCHAR(30),
    subquery VARCHAR(30)
);

CREATE TABLE icons (
    icon_name VARCHAR(100),
    filepath VARCHAR(200)
);

CREATE TABLE images (
    image_name VARCHAR(100),
    filepath VARCHAR(200)
);

CREATE TABLE item_filters (
    id BIGINT(10),
    class_name VARCHAR(50),
    name VARCHAR(50),
    shop_image_webp VARCHAR(200),
    item_slot_type VARCHAR(50),
    item_tier INT(1),
    is_active_item INT(1),
    cost INT(5),
	imbue VARCHAR(50),
	property VARCHAR(50),
	stat_value VARCHAR(50),
	stat_scale VARCHAR(50)
);

