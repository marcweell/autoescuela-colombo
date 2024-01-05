start transaction;

drop database if exists escuela;

create database escuela;

use escuela;

create table if not exists site_menu(
    id bigint auto_increment not null primary key,
    name varchar(400) not null not null,
    code varchar(191) not null unique,
    parent_menu_id bigint,
    route varchar(400),
    uri varchar(400),
    order_index int default 0,
    prefer enum('route', 'uri') not null default 'route',
    icon_class varchar(100),
    target enum('ajax', 'parent', '_blank') not null default 'parent',
    active boolean not null default true,
    created_at datetime default current_timestamp,
    updated_at datetime default null,
    deleted_at datetime default null
);

create table if not exists language(
    id bigint auto_increment not null primary key,
    name varchar(191),
    code varchar(191) not null unique,
    description text,
    created_at datetime default current_timestamp(),
    updated_at datetime default null,
    deleted_at datetime
);

create table if not exists module(
    id bigint auto_increment not null primary key,
    name varchar(191),
    code varchar(191) not null unique,
    description text,
    active boolean not null default true,
    created_at datetime default current_timestamp(),
    updated_at datetime default null,
    deleted_at datetime
);

create table if not exists gender(
    id bigint auto_increment not null primary key,
    name varchar(60),
    code varchar(191) not null unique,
    created_at datetime default current_timestamp(),
    updated_at datetime default null,
    deleted_at datetime
);

create table if not exists marital_status(
    id bigint auto_increment not null primary key,
    name varchar(60),
    code varchar(191) not null unique,
    created_at datetime default current_timestamp(),
    updated_at datetime default null,
    deleted_at datetime
);

create table if not exists contact_type(
    id bigint auto_increment not null primary key,
    name varchar(60) unique,
    code varchar(191) not null unique,
    created_at datetime default current_timestamp(),
    updated_at datetime default null,
    deleted_at datetime
);

create table if not exists document_type(
    id bigint auto_increment not null primary key,
    name varchar(191),
    code varchar(191) not null unique,
    description text,
    created_at datetime default current_timestamp(),
    updated_at datetime default null,
    deleted_at datetime
);

create table if not exists notification_model(
    id bigint auto_increment not null primary key,
    code varchar(191) not null unique,
    name varchar(100),
    title varchar(100),
    message varchar(100),
    created_at datetime default current_timestamp(),
    updated_at datetime default null,
    deleted_at datetime
);

create table if not exists email_template(
    id bigint not null auto_increment primary key,
    name varchar(191) not null,
    subject varchar(100) not null,
    body longtext not null,
    created_at datetime default current_timestamp(),
    updated_at datetime default null,
    deleted_at datetime default null
);

/* essenciais -*/
/* geo-localizacao */
create table if not exists country(
    id bigint auto_increment not null primary key,
    code varchar(191) not null unique,
    name varchar(100),
    locale varchar(50),
    country_code varchar(50),
    phone_digits_num int default 9,
    created_at datetime default current_timestamp(),
    updated_at datetime default null,
    deleted_at datetime default null
);

create table if not exists city(
    id bigint auto_increment not null primary key,
    code varchar(191) not null unique,
    name varchar(191) not null,
    country_id bigint,
    latitude float,
    longitude float,
    timezone int(6),
    created_at datetime default current_timestamp(),
    updated_at datetime default null,
    deleted_at datetime default null,
    foreign key(country_id) references country(id) on delete cascade
);

create table if not exists village(
    id bigint auto_increment not null primary key,
    code varchar(191) not null unique,
    name varchar(50),
    latitude float,
    longitude float,
    city_id bigint not null,
    created_at datetime default current_timestamp(),
    updated_at datetime default null,
    deleted_at datetime default null,
    foreign key(city_id) references city(id) on delete cascade
);

/* geo-localizacao -- */
/* user */
create table if not exists role(
    id bigint auto_increment not null primary key,
    name varchar(191),
    code varchar(191) not null unique,
    description text,
    created_at datetime default current_timestamp(),
    updated_at datetime default null,
    deleted_at datetime
);

create table if not exists permission(
    id bigint auto_increment not null primary key,
    module_id bigint not null,
    name varchar(191),
    code varchar(191) not null unique,
    description text,
    created_at datetime default current_timestamp(),
    updated_at datetime default null,
    deleted_at datetime,
    foreign key(module_id) references module(id) on delete cascade
);

create table if not exists role_permission(
    id bigint auto_increment not null primary key,
    permission_id bigint not null,
    role_id bigint not null,
    needs_maker_checker boolean not null default false,
    created_at datetime default current_timestamp(),
    updated_at datetime default null,
    deleted_at datetime default null,
    foreign key(permission_id) references permission(id) on delete cascade,
    foreign key(role_id) references role(id) on delete cascade
);

create table if not exists user(
    id bigint auto_increment not null primary key,
    code varchar(191) not null unique,
    password varchar(80),
    photo varchar(191),
    name varchar(191),
    last_name varchar(191),
    father_name varchar(191),
    mother_name varchar(191),
    idd_country_id bigint,
    phone varchar(20),
    city_id bigint,
    email varchar(150),
    address text,
    born_date date,
    role_id bigint,
    type enum('admin', 'user') not null default 'user',
    active boolean not null default true,
    activation_token varchar(100),
    remember_token varchar(100),
    created_at datetime default current_timestamp(),
    updated_at datetime default null,
    deleted_at datetime default null,
    foreign key(role_id) references role(id) on delete cascade,
    foreign key(city_id) references city(id) on delete cascade,
    foreign key(idd_country_id) references country(id) on delete cascade
);

create table if not exists user_document(
    id bigint auto_increment not null primary key,
    user_id bigint not null,
    code varchar(191) not null unique,
    document_type_id bigint not null,
    file varchar(400) not null,
    file_type varchar(11),
    extension varchar(20),
    created_at datetime default current_timestamp(),
    updated_at datetime default null,
    deleted_at datetime default null,
    foreign key(document_type_id) references document_type(id) on delete cascade,
    foreign key(user_id) references user(id) on delete cascade
);

create table if not exists user_contact(
    id bigint auto_increment not null primary key,
    user_id bigint not null,
    code varchar(191) not null unique,
    contact_type_id bigint not null,
    contact varchar(400) not null,
    created_at datetime default current_timestamp(),
    updated_at datetime default null,
    deleted_at datetime default null,
    foreign key(contact_type_id) references contact_type(id) on delete cascade,
    foreign key(user_id) references user(id) on delete cascade
);

create table if not exists page_visit(
    id bigint auto_increment not null primary key,
    route_name varchar(400),
    url varchar(400),
    ip varchar(100),
    browser varchar(191),
    device varchar(191),
    user_agent varchar(191),
    sessionid varchar(191),
    latiutde float,
    longitude float,
    user_id bigint,
    created_at datetime default current_timestamp(),
    updated_at datetime default null,
    deleted_at datetime default null,
    foreign key(user_id) references user(id) on delete cascade
);

create table if not exists faq(
    id bigint auto_increment not null primary key,
    title varchar(191),
    code varchar(191) not null unique,
    description text,
    language_id bigint,
    created_at datetime default current_timestamp(),
    updated_at datetime default null,
    deleted_at datetime default null,
    foreign key(language_id) references language(id) on delete cascade
);

create table if not exists faq_answer(
    id bigint auto_increment not null primary key,
    code varchar(191) not null unique,
    description text,
    user_id bigint,
    language_id bigint,
    created_at datetime default current_timestamp(),
    updated_at datetime default null,
    deleted_at datetime default null,
    foreign key(user_id) references user(id) on delete cascade,
    foreign key(language_id) references language(id) on delete cascade
);

create table if not exists notification(
    id bigint auto_increment not null primary key,
    code varchar(191) not null unique,
    title varchar(100),
    message text,
    user_id bigint not null,
    isread boolean not null default true,
    created_at datetime default current_timestamp(),
    updated_at datetime default null,
    deleted_at datetime default null,
    foreign key(user_id) references user(id) on delete cascade
);

create table if not exists password_change(
    id bigint auto_increment not null primary key,
    code varchar(191) not null unique,
    user_id bigint not null,
    password varchar(200),
    new_password varchar(200) not null,
    created_at datetime default current_timestamp(),
    foreign key(user_id) references user(id) on delete cascade
);

create table if not exists session_history(
    id bigint auto_increment not null primary key,
    code varchar(191) not null unique,
    ip varchar(100),
    browser varchar(191),
    device varchar(191),
    user_agent varchar(191),
    sessionid varchar(191),
    latiutde float,
    longitude float,
    success boolean not null default false,
    user_id bigint not null,
    created_at datetime default current_timestamp(),
    updated_at datetime default null,
    deleted_at datetime default null,
    foreign key(user_id) references user(id) on delete cascade
);

/* course */
create table if not exists academic_degree(
    id bigint auto_increment not null primary key,
    code varchar(191) not null unique,
    name varchar(60),
    description varchar(100),
    created_at datetime default current_timestamp(),
    updated_at datetime default null,
    deleted_at datetime
);

create table if not exists course_category(
    id bigint not null auto_increment primary key,
    code varchar(191) not null unique,
    name varchar(191) not null,
    created_at datetime default current_timestamp(),
    updated_at datetime default null,
    deleted_at datetime default null
);

/* course */
create table if not exists course(
    id bigint not null auto_increment primary key,
    course_category_id bigint null,
    code varchar(191) not null unique,
    name varchar(191) not null,
    logo varchar(191) default null,
    cover_photo varchar(191) default null,
    description text default null,
    active boolean not null default true,
    created_at datetime default current_timestamp(),
    updated_at datetime default null,
    deleted_at datetime default null,
    foreign key(course_category_id) references course_category(id) on delete cascade
);

create table if not exists course_attachment(
    id bigint not null auto_increment primary key,
    code varchar(191) not null unique,
    course_id bigint not null,
    file varchar(400) not null,
    file_type varchar(11),
    extension varchar(20),
    created_at datetime default current_timestamp(),
    updated_at datetime default null,
    deleted_at datetime default null,
    foreign key(course_id) references course(id) on delete cascade
);

/** events */
/** Survey */
create table if not exists survey_category(
    id bigint not null auto_increment primary key,
    code varchar(191) not null unique,
    name varchar(191) not null,
    created_at datetime default current_timestamp(),
    updated_at datetime default null,
    deleted_at datetime default null
);

create table if not exists survey(
    id bigint not null auto_increment primary key,
    code varchar(191) not null unique,
    logo varchar(300),
    survey_category_id bigint not null,
    course_id bigint not null,
    language_id bigint,
    name varchar(191) not null,
    description text,
    long_description text,
    start_date datetime,
    end_date datetime,
    footer varchar(191),
    font varchar(191),
    bg_image varchar(191),
    bg_color varchar(191),
    text_color varchar(191),
    active boolean not null default true,
    created_at datetime default current_timestamp(),
    updated_at datetime default null,
    deleted_at datetime default null,
    foreign key(language_id) references language(id) on delete cascade,
    foreign key(survey_category_id) references survey_category(id) on delete cascade,
    foreign key(course_id) references course(id) on delete cascade
);

create table if not exists survey_attachment(
    id bigint not null auto_increment primary key,
    code varchar(191) not null unique,
    survey_id bigint not null,
    file varchar(400) not null,
    file_type varchar(11),
    extension varchar(20),
    created_at datetime default current_timestamp(),
    updated_at datetime default null,
    deleted_at datetime default null,
    foreign key(survey_id) references survey(id) on delete cascade
);

create table if not exists person_data(
    id bigint not null auto_increment primary key,
    code varchar(191) not null unique,
    survey_id bigint not null,
    name varchar(400),
    char_limit int null,
    data_type enum(
        'text',
        'rich_text',
        'boolean',
        'number',
        'int_number',
        'date',
        'year',
        'month',
        'day',
        'multiple'
    ),
    created_at datetime default current_timestamp(),
    updated_at datetime default null,
    deleted_at datetime default null,
    foreign key(survey_id) references survey(id) on delete cascade
);

create table if not exists person_data_option(
    id bigint not null auto_increment primary key,
    code varchar(191) not null unique,
    person_data_id bigint not null,
    option_ text,
    created_at datetime default current_timestamp(),
    updated_at datetime default null,
    deleted_at datetime default null,
    foreign key(person_data_id) references person_data(id) on delete cascade
);

create table if not exists survey_question(
    id bigint not null auto_increment primary key,
    code varchar(191) not null unique,
    survey_id bigint not null,
    question text,
    question_type enum(
        "single-choice-radio",
        "multiple-choice",
        "open-ended-single",
        "best-worst"
    ),
    ponctuation float,
    _lines int not null default 3,
    created_at datetime default current_timestamp(),
    updated_at datetime default null,
    deleted_at datetime default null,
    foreign key(survey_id) references survey(id) on delete cascade
);

create table if not exists survey_question_option(
    id bigint not null auto_increment primary key,
    code varchar(191) not null unique,
    survey_question_id bigint not null,
    sort_index int,
    option_ text,
    ponctuation float,
    correct boolean default null,
    created_at datetime default current_timestamp(),
    updated_at datetime default null,
    deleted_at datetime default null,
    foreign key(survey_question_id) references survey_question(id) on delete cascade
);

create table if not exists survey_person(
    id bigint not null auto_increment primary key,
    code varchar(191) not null unique,
    survey_id bigint not null,
    city_id bigint,
    user_id bigint,
    tag text,
    created_at datetime default current_timestamp(),
    updated_at datetime default null,
    deleted_at datetime default null,
    foreign key(user_id) references user(id) on delete cascade,
    foreign key(survey_id) references survey(id) on delete cascade,
    foreign key(city_id) references city(id) on delete cascade
);

create table if not exists survey_person_data(
    id bigint not null auto_increment primary key,
    code varchar(191) not null unique,
    survey_person_id bigint not null,
    survey_question_option_id bigint,
    data text,
    created_at datetime default current_timestamp(),
    updated_at datetime default null,
    deleted_at datetime default null,
    foreign key(survey_person_id) references survey_person(id) on delete cascade,
    foreign key(survey_question_option_id) references survey_question_option(id) on delete cascade
);

create table if not exists survey_answer(
    id bigint not null auto_increment primary key,
    code varchar(191) not null unique,
    survey_person_id bigint not null,
    survey_question_id bigint,
    answer text,
    survey_question_option_id bigint,
    correct boolean default null,
    created_at datetime default current_timestamp(),
    updated_at datetime default null,
    deleted_at datetime default null,
    foreign key(survey_question_option_id) references survey_question_option(id) on delete cascade,
    foreign key(survey_question_id) references survey_question(id) on delete cascade,
    foreign key(survey_person_id) references survey_person(id) on delete cascade
);

create table if not exists page_info (
    id bigint not null auto_increment primary key,
    name varchar(400) NOT NULL,
    code varchar(300) NOT NULL,
    content longtext DEFAULT NULL,
    line_height int(11) NOT NULL DEFAULT 3,
    content_type enum(
        'plain_text',
        'rich_text',
        'color',
        'number',
        'date',
        'time',
        'file'
    ) NOT NULL DEFAULT 'plain_text',
    filetypes varchar(300) DEFAULT NULL,
    regex varchar(300) DEFAULT NULL,
    active tinyint(1) NOT NULL DEFAULT 1,
    multiple tinyint(1) NOT NULL DEFAULT 0,
    child_index varchar(400) DEFAULT NULL,
    parent_id bigint(20) DEFAULT NULL,
    created_at datetime DEFAULT current_timestamp(),
    updated_at datetime DEFAULT NULL,
    deleted_at datetime DEFAULT NULL
);

INSERT INTO
    page_info (
        id,
        name,
        code,
        content,
        line_height,
        content_type,
        filetypes,
        regex,
        active,
        multiple,
        child_index,
        parent_id,
        created_at,
        updated_at,
        deleted_at
    )
VALUES
    (
        1,
        'Nombre de Empresa',
        'company.name',
        NULL,
        1,
        'plain_text',
        NULL,
        NULL,
        1,
        0,
        NULL,
        NULL,
        '2023-12-26 12:32:57',
        NULL,
        NULL
    ),
    (
        2,
        'Direccion',
        'company.address',
        NULL,
        3,
        'plain_text',
        NULL,
        NULL,
        1,
        0,
        NULL,
        NULL,
        '2023-12-26 12:32:57',
        NULL,
        NULL
    ),
    (
        3,
        'Ciudad',
        'company.city',
        NULL,
        1,
        'plain_text',
        NULL,
        NULL,
        1,
        0,
        NULL,
        NULL,
        '2023-12-26 12:32:57',
        NULL,
        NULL
    ),
    (
        4,
        'Departamento',
        'company.depart',
        NULL,
        1,
        'plain_text',
        NULL,
        NULL,
        1,
        0,
        NULL,
        NULL,
        '2023-12-26 12:32:57',
        NULL,
        NULL
    ),
    (
        5,
        'Pais',
        'company.country',
        NULL,
        1,
        'plain_text',
        NULL,
        NULL,
        1,
        0,
        NULL,
        NULL,
        '2023-12-26 12:32:57',
        NULL,
        NULL
    ),
    (
        6,
        'Telefono',
        'company.phone',
        '857766468',
        1,
        'plain_text',
        NULL,
        NULL,
        1,
        0,
        NULL,
        NULL,
        '2023-12-26 12:32:57',
        '2023-12-28 16:30:24',
        NULL
    ),
    (
        7,
        'Celular',
        'company.cell',
        NULL,
        1,
        'plain_text',
        NULL,
        NULL,
        1,
        0,
        NULL,
        NULL,
        '2023-12-26 12:32:57',
        NULL,
        NULL
    ),
    (
        8,
        'Email',
        'company.email',
        NULL,
        1,
        'number',
        NULL,
        NULL,
        1,
        0,
        NULL,
        NULL,
        '2023-12-26 12:32:57',
        NULL,
        NULL
    ),
    (
        9,
        'IVA',
        'company.iva',
        NULL,
        1,
        'plain_text',
        NULL,
        NULL,
        1,
        0,
        NULL,
        NULL,
        '2023-12-26 12:32:57',
        NULL,
        NULL
    ),
    (
        10,
        'Logo',
        'company.logo',
        '226e5b666fd5743a3fe16df38602b7dc',
        3,
        'file',
        'image/*',
        NULL,
        1,
        0,
        NULL,
        NULL,
        '2023-12-26 12:32:57',
        '2023-12-30 09:46:49',
        NULL
    );

insert into
    role(name, code, created_at)
values
    (
        'super administrador',
        'b3ea2c7964ed59bc701dee86cdcbc3a6',
        now()
    ),
    (
        'administrador',
        'b379cacb210a496a98fd1278906f8d50',
        now()
    ),
    (
        'monitor',
        '46c6ba2fc1e31d273402d774a6aa3a0f',
        now()
    ),
    (
        'auditor',
        '2706c21afaae744b4ab494b963a10995',
        now()
    );

insert into
    user(
        code,
        name,
        last_name,
        password,
        active,
        role_id,
        type,
        created_at
    )
values
    (
        'admin',
        'nelson',
        'flores',
        '$2y$10$G8PKzvTdpFsDuo14rYuWSedqd85WH93rQ0dElSN.3/azMNIhYT6oK',
        true,
        1,
        'support',
        now()
    );

commit;
