The 7 tables in the DB are formatted as follows:
```sql
CREATE TABLE components {
    class_name VARCHAR(50)
};

CREATE TABLE components_tofrom {
    class_name VARCHAR(50),
    component_items VARCHAR(50)
};

CREATE TABLE icons (
    graphic_name VARCHAR(100),
    filepath VARCHAR(200)
);

CREATE TABLE images (
    graphic_name VARCHAR(100),
    filepath VARCHAR(200)
);

CREATE TABLE tags (
    id INT(2),
    file_name VARCHAR(30),
    display_name VARCHAR(30),
    filepath VARCHAR(30),
    subquery VARCHAR(30)
);

/* properties, elevated_properties, important_properties are JSON */
CREATE TABLE tooltips (
    class_name VARCHAR(50),
    section_type VARCHAR(20),
    loc_string VARCHAR(10000),
    properties VARCHAR(200),
    elevated_properties VARCHAR(200),
    important_properties VARCHAR(200)
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
    stat_value_display VARCHAR(50),
	stat_value VARCHAR(50),
	stat_scale VARCHAR(50),
    stat_scale_type VARCHAR(50),
    postfix VARCHAR(10),
    label VARCHAR(50),
    icon VARCHAR(200)
);