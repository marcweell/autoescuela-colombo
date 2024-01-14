
CREATE TABLE settings (
    id bigint(20) NOT NULL,
    name varchar(400) NOT NULL,
    code varchar(300) NOT NULL,
    content longtext DEFAULT NULL,
    content_type enum(
        'plain_text',
        'rich_text',
        'color',
        'number',
        'date',
        'time',
        'file'
    ) DEFAULT NULL,
    active tinyint(1) NOT NULL DEFAULT 1,
    multiple tinyint(1) NOT NULL DEFAULT 0,
    child_index varchar(400) DEFAULT NULL,
    parent_id bigint(20) DEFAULT NULL,
    created_at datetime NULL DEFAULT current_timestamp,
    updated_at datetime NULL DEFAULT NULL,
    deleted_at datetime NULL DEFAULT NULL
);

create table if not exists schedule(
    id bigint auto_increment not null primary key,
    date_of_week int not null unique,
    open_time time,
    close_time time,
    active boolean not null default true,
    created_at datetime default current_timestamp,
    updated_at datetime default null,
    deleted_at datetime default null
);

create table if not exists question_category(
    id bigint not null auto_increment primary key,
    code varchar(191) not null unique,
    name varchar(191) not null,
    icon_hex_color varchar(191),
    icon varchar(191),
    alter table survey_category add traffic_question int null;
    alter table survey_category add traffic_question_corrects int null;
    alter table survey_category add mechanics_question int null;
   alter table survey_category add mechanics_question_corrects int null;
    time_minute int;
    active boolean not null default true,
    created_at datetime default current_timestamp,
    updated_at datetime default null,
    deleted_at datetime default null
);

create table if not exists question(
    id bigint not null auto_increment primary key,
    code varchar(191) not null unique,
    question text not null,
    answer text not null,
    opt_a text,
    opt_b text,
    opt_c text,
    opt_d text,
    opt_e text,
    icon varchar(191),
    image varchar(191),
    course varchar(191),
    general_course varchar(191),
    type varchar(191),
    question_category_id bigint not null,
    created_at datetime default current_timestamp,
    updated_at datetime default null,
    deleted_at datetime default null,
    foreign key(question_category_id) references question_category(id) on delete cascade
);

create table if not exists sur_category(
    id bigint not null auto_increment primary key,
    code varchar(191) not null unique,
    name varchar(191) not null,
    icon_hex_color varchar(191),
    icon varchar(191),
    active boolean not null default true,
    created_at datetime default current_timestamp,
    updated_at datetime default null,
    deleted_at datetime default null
);

create table if not exists page(
    id bigint not null auto_increment primary key,
    code varchar(191) not null unique,
    title text not null,
    subtitle text not null,
    preface longtext not null,
    description longtext not null,
    icon varchar(191),
    hex_color varchar(191),
    image varchar(191),
    video varchar(191),
    file varchar(191),
    price float,
    price_promo float,
    page_category_id bigint not null,
    created_at datetime default current_timestamp,
    updated_at datetime default null,
    deleted_at datetime default null,
    foreign key(page_category_id) references page_category(id) on delete cascade
);

create table if not exists paragraph(
    id bigint not null auto_increment primary key,
    code varchar(191) not null unique,
    title text not null,
    description longtext not null,
    icon varchar(191),
    image varchar(191),
    page_id bigint not null,
    created_at datetime default current_timestamp,
    updated_at datetime default null,
    deleted_at datetime default null,
    foreign key(page_id) references page(id) on delete cascade
);

create table if not exists page_course(
    id bigint not null auto_increment primary key,
    code varchar(191) not null unique,
    link_pdf varchar(191),
    num_course varchar(191),
    course_category varchar(191),
    description longtext not null,
    page_id bigint not null,
    created_at datetime default current_timestamp,
    updated_at datetime default null,
    deleted_at datetime default null,
    foreign key(page_id) references page(id) on delete cascade
);



create table if not exists user(
    id bigint auto_increment not null primary key,

    code varchar(191) not null unique,
    password varchar(320),

    names varchar(191),
    father_name varchar(191),
    mother_name varchar(191),

    national_id varchar(191),
    phone varchar(20),
    email varchar(150),
    address text,
    born_date date,

    question_category_id bigint,
    driving_course varchar(150),
    form_type varchar(150),

    passport_file varchar(300),
    medical_evaluation_file varchar(300),
    photo varchar(191),

    type varchar(100),
    activation_token varchar(100),
    remember_token varchar(100),
    active boolean not null default true,
    created_at datetime default current_timestamp,
    updated_at datetime default null,
    deleted_at datetime default null,
    foreign key(question_category_id) references question_category(id) on delete cascade
);

create table if not exists notification(
    id bigint auto_increment not null primary key,
    code varchar(191) not null unique,
    title varchar(100),
    message text,
    user_id bigint not null,
    isread boolean not null default true,
    created_at datetime default current_timestamp,
    updated_at datetime default null,
    deleted_at datetime default null,
    foreign key(user_id) references user(id) on delete cascade
);
