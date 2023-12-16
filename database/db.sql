start transaction;

drop database if exists escuela;

create database escuela;

use escuela;

/** essenciais */
create table if not exists system_settings(
    id bigint auto_increment not null primary key,
    name varchar(400) not null,
    code varchar(191) not null unique,
    value text,
    default_value text,
    available_values text comment "name[code]...",
    active boolean not null default true,
    created_at timestamp default current_timestamp,
    updated_at timestamp default null,
    deleted_at timestamp default null
);


create table if not exists settings(
    id bigint auto_increment not null primary key,
    name varchar(400) not null,
    code varchar(191) not null unique,
    default_value text,
    user_type enum("admin","user","everyone") not null default "admin",
    active boolean not null default true,
    created_at timestamp default current_timestamp,
    updated_at timestamp default null,
    deleted_at timestamp default null
);


create table if not exists user(
    id bigint auto_increment not null primary key,
    code varchar(191) not null unique,
    profile_picture varchar(191),
    name varchar(191),
    last_name varchar(191),
    password varchar(80),
    active boolean not null default true,
    city_id bigint,
    phone varchar(20),
    email varchar(150),
    email varchar(150),
    activation_token varchar(100),
    remember_token varchar(100),
    created_at timestamp default current_timestamp,
    updated_at timestamp default null,
    deleted_at timestamp default null
);



create table if not exists admin(
    id bigint auto_increment not null primary key,
    code varchar(191) not null unique,
    profile_picture varchar(191),
    name varchar(191),
    last_name varchar(191),
    password varchar(80),
    active boolean not null default true,
    idd_country_id bigint,
    city_id bigint,
    phone varchar(20),
    role_id bigint,
    email varchar(150),
    activation_token varchar(100),
    remember_token varchar(100),
    type enum('support', 'user') not null default 'user',
    created_at timestamp default current_timestamp,
    updated_at timestamp default null,
    deleted_at timestamp default null,
    foreign key(role_id) references role(id) on delete cascade,
    foreign key(city_id) references city(id) on delete cascade,
    foreign key(idd_country_id) references country(id) on delete cascade
);

create table if not exists admin_settings(
    id bigint auto_increment not null primary key,
    code varchar(191) not null unique,
    settings_id bigint not null,
    admin_id bigint not null,
    _value text,
    created_at timestamp default current_timestamp,
    updated_at timestamp default null,
    deleted_at timestamp default null,
    foreign key(settings_id) references settings(id) on delete cascade,
    foreign key(admin_id) references admin(id) on delete cascade
);

create table if not exists notification(
    id bigint auto_increment not null primary key,
    code varchar(191) not null unique,
    title varchar(100),
    message text,
    user_id bigint not null,
    isread boolean not null default true,
    created_at timestamp default current_timestamp,
    updated_at timestamp default null,
    deleted_at timestamp default null,
    foreign key(user_id) references user(id) on delete cascade
);

create table if not exists password_change(
    id bigint auto_increment not null primary key,
    code varchar(191) not null unique,
    user_id bigint not null,
    password varchar(200),
    new_password varchar(200) not null,
    created_at timestamp default current_timestamp,
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
    created_at timestamp default current_timestamp,
    foreign key(user_id) references user(id) on delete cascade
);

create table if not exists operation_history(
    id bigint not null auto_increment primary key,
    user_id bigint not null,
    code varchar(190) default null,
    description text default null,
    classmethod varchar(400) default null,
    old_serialized_object text default null,
    current_serialized_object text default null,
    object_table varchar(190) default null,
    sessionid varchar(190) default null,
    module_id bigint,
    created_at timestamp default current_timestamp,
    updated_at timestamp default null,
    deleted_at timestamp default null,
    foreign key(user_id) references user(id) on delete cascade
);

create table if not exists admin_session_history(
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
    admin_id bigint not null,
    created_at timestamp default current_timestamp,
    foreign key(admin_id) references admin(id) on delete cascade
);

create table if not exists admin_operation_history(
    id bigint not null auto_increment primary key,
    admin_id bigint not null,
    code varchar(190) default null,
    description text default null,
    classmethod varchar(400) default null,
    old_serialized_object text default null,
    current_serialized_object text default null,
    object_table varchar(190) default null,
    sessionid varchar(190) default null,
    module_id bigint,
    created_at timestamp default current_timestamp,
    updated_at timestamp default null,
    deleted_at timestamp default null,
    foreign key(admin_id) references admin(id) on delete cascade
);

/* company */
create table if not exists company(
    id bigint not null auto_increment primary key,
    city_id bigint null,
    code varchar(191) not null unique,
    name varchar(191) not null,
    website varchar(191) default null,
    postal_code varchar(191) default null,
    logo varchar(191) default null,
    cover_photo varchar(191) default null,
    description text default null,
    active boolean not null default true,
    created_at timestamp default current_timestamp,
    updated_at timestamp default null,
    deleted_at timestamp default null,
    foreign key(city_id) references city(id) on delete cascade
);

create table if not exists company_contact(
    id bigint auto_increment not null primary key,
    code varchar(191) not null unique,
    company_id bigint not null,
    contact_type_id bigint not null,
    public boolean not null default true,
    contact varchar(191) not null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default null,
    deleted_at timestamp default null,
    foreign key(company_id) references company(id) on delete cascade
);

create table if not exists department(
    id bigint auto_increment not null primary key,
    company_id bigint not null,
    city_id bigint,
    name varchar(191) not null,
    code varchar(191) not null unique,
    description text,
    created_at timestamp default current_timestamp,
    updated_at timestamp default null,
    deleted_at timestamp default null,
    foreign key(company_id) references company(id) on delete cascade,
    foreign key(city_id) references city(id) on delete cascade
);




create table if not exists employee(
    id bigint not null auto_increment primary key,
    code varchar(191) not null unique,
    photo varchar(191),
    name varchar(191),
    last_name varchar(191),
    phone varchar(20),
    email varchar(191) default null,
    company_id bigint not null,
    born_date date,
    city_id bigint,
    academic_degree_id bigint,
    brute_salary float(11, 2),
    household int,
    gender_id bigint,
    active boolean default true,
    admin_id bigint not null,
    join_date date not null,
    total_experience int,
    created_at timestamp default current_timestamp,
    updated_at timestamp default null,
    deleted_at timestamp default null,
    foreign key(company_id) references company(id) on delete cascade,
    foreign key(admin_id) references admin(id) on delete cascade,
    foreign key(city_id) references city(id) on delete cascade,
    foreign key(gender_id) references gender(id) on delete cascade
);

create table if not exists employee_document(
    id bigint auto_increment not null primary key,
    code varchar(191) not null unique,
    document_type_id bigint,
    doc_number varchar(150) not null,
    emission_date date,
    expire_date date not null,
    employee_id bigint not null unique,
    created_at timestamp default current_timestamp,
    updated_at timestamp default null,
    deleted_at timestamp default null,
    file_id bigint,
    foreign key(file_id) references file(id) on delete cascade,
    foreign key(document_type_id) references document_type(id) on delete cascade,
    foreign key(employee_id) references employee(id) on delete cascade
);

create table if not exists employee_contact(
    id bigint auto_increment not null primary key,
    code varchar(191) not null unique,
    type enum("email","phone") not null default "phone",
    idd_country_id bigint,
    contact text,
    employee_id bigint not null unique,
    created_at timestamp default current_timestamp,
    updated_at timestamp default null,
    deleted_at timestamp default null,
    foreign key(idd_country_id) references country(id) on delete cascade,
    foreign key(employee_id) references employee(id) on delete cascade
);

create table if not exists employee_address(
    id bigint auto_increment not null primary key,
    code varchar(191) not null unique,
    city_id bigint,
    description text,
    employee_id bigint not null unique,
    created_at timestamp default current_timestamp,
    updated_at timestamp default null,
    deleted_at timestamp default null,
    foreign key(city_id) references city(id) on delete cascade,
    foreign key(employee_id) references employee(id) on delete cascade
);

create table if not exists employee_department(
    id bigint auto_increment not null primary key,
    code varchar(191) not null unique,
    employee_id bigint not null,
    department_id bigint not null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default null,
    deleted_at timestamp default null,
    foreign key(employee_id) references employee(id) on delete cascade,
    foreign key(department_id) references department(id) on delete cascade
);


/** financas */
create table if not exists item_category(
    id bigint not null auto_increment primary key,
    parent_id bigint default null,
    code varchar(191) not null unique,
    name varchar(191) not null,
    description text,
    active boolean not null default true,
    created_at timestamp default current_timestamp,
    updated_at timestamp default null,
    deleted_at timestamp default null
);

create table if not exists item(
    id bigint not null auto_increment primary key,
    code varchar(191) not null unique,
    cover varchar(300),
    company_id bigint not null,
    item_code varchar(191) not null,
    item_category_id bigint default null,
    name varchar(191) not null,
    buy_coust double(15, 4) not null default 0.0,
    sell_coust double(15, 4) not null,
    currency_id bigint,
    stock int(11) not null default 1,
    active boolean not null default true,
    description text,
    created_at timestamp default current_timestamp,
    updated_at timestamp default null,
    deleted_at timestamp default null,
    foreign key(currency_id) references currency(id) on delete cascade,
    foreign key(item_category_id) references item_category(id) on delete cascade,
    foreign key(company_id) references company(id) on delete cascade
);

create table if not exists item_attachment(
    id bigint not null auto_increment primary key,
    code varchar(191) not null unique,
    item_id bigint not null,
    download_id bigint,
    file_id bigint,
    created_at timestamp default current_timestamp,
    updated_at timestamp default null,
    deleted_at timestamp default null,
    foreign key(file_id) references file(id) on delete cascade,
    foreign key(item_id) references item(id) on delete cascade
);



create table if not exists exchange_rate(
    id bigint not null auto_increment primary key,
    base_currency_id bigint not null comment 'base = USD',
    target_currency_id bigint not null,
    rate DECIMAL(10, 4) not null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default null,
    deleted_at timestamp default null,
    foreign key(base_currency_id) references currency(id) on delete cascade,
    foreign key(target_currency_id) references currency(id) on delete cascade
);


create table if not exists payment_method(
    id bigint not null auto_increment primary key,
    code varchar(191) not null unique,
    name varchar(191) not null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default null,
    deleted_at timestamp default null
);


create table if not exists payment_method_fee(
    id bigint not null auto_increment primary key,
    code varchar(191) not null unique,
    fee double(10,2) not null default 0,
    payment_method_id bigint not null,
    fee_type enum("numeric","percent") not null default "numeric",
    created_at timestamp default current_timestamp,
    updated_at timestamp default null,
    deleted_at timestamp default null,
    foreign key(payment_method_id) references payment_method(id) on delete cascade
);




create table if not exists bank(
    id bigint not null auto_increment primary key,
    name varchar(191) not null,
    code varchar(191) not null unique,
    logo varchar(300),
    description text,
    active boolean not null default true,
    hex_color varchar(9),
    country_id bigint not null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default null,
    deleted_at timestamp default null,
    foreign key(country_id) references country(id) on delete cascade
);

create table if not exists bank_contact(
    id bigint not null auto_increment primary key,
    contact_type_id bigint not null,
    contract varchar(400) not null unique,
    active boolean not null default true,
    bank_id bigint not null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default null,
    deleted_at timestamp default null,
    foreign key(bank_id) references bank(id) on delete cascade
);



create table if not exists wallet(
    id bigint auto_increment not null primary key,
    code varchar(191) not null unique,
    tag varchar(80),
    user_id bigint not null,
    company_id bigint not null,
    currency_id bigint,
    primary_wallet boolean not null default false,
    balance DECIMAL(18, 2) not null default 0.0,
    payment_token varchar(300) not null,
    status enum('open','on_hold') not null default 'open',
    created_at timestamp default current_timestamp,
    updated_at timestamp default null,
    deleted_at timestamp default null,
    foreign key(company_id) references company(id) on delete cascade,
    foreign key(user_id) references user(id) on delete cascade,
    foreign key(currency_id) references currency(id) on delete cascade
);



create table if not exists card(
    id bigint not null auto_increment primary key,
    bank_id bigint not null,
    currency_id bigint not null,
    card_number int not null,
    expiration_date int not null,
    cvv int not null,
    user_id bigint not null,
    active boolean not null default true,
    created_at timestamp default current_timestamp,
    updated_at timestamp default null,
    deleted_at timestamp default null,
    foreign key(user_id) references user(id) on delete cascade,
    foreign key(bank_id) references bank(id) on delete cascade,
    foreign key(currency_id) references currency(id) on delete cascade
);

create table if not exists transaction(
    id bigint not null auto_increment primary key,
    code varchar(191) not null unique,
    wallet_id bigint not null,
    exchange_rate_id bigint,
    payment_token varchar(300),
    card_id bigint,
    amount double(15, 4) not null default 0,
    payment_date date not null,
    payment_method_id bigint not null,
    description text,
    type enum('credit', 'debt', 'transfer', 'refund','withdraw') not null default 'debt',
    paid enum('unclaimed','canceled','completed') not null default 'unclaimed',
    created_at timestamp default current_timestamp,
    updated_at timestamp default null,
    deleted_at timestamp default null,
    foreign key(exchange_rate_id) references exchange_rate(id) on delete cascade,
    foreign key(card_id) references card(id) on delete cascade,
    foreign key(payment_method_id) references payment_method(id) on delete cascade,
    foreign key(wallet_id) references wallet(id) on delete cascade
);




create table if not exists topup(
    id bigint not null auto_increment primary key,
    code varchar(191) not null unique,
    currency_id bigint not null,
    wallet_id bigint not null,
    card_id bigint,
    transaction_id bigint,
    amount double(15, 4) not null default 0,
    payment_date date not null,
    status enum('unclaimed','canceled','failed','completed') not null default 'unclaimed',
    created_at timestamp default current_timestamp,
    updated_at timestamp default null,
    deleted_at timestamp default null,
    foreign key(currency_id) references currency(id) on delete cascade,
    foreign key(card_id) references card(id) on delete cascade,
    foreign key(transaction_id) references transaction(id) on delete cascade,
    foreign key(wallet_id) references wallet(id) on delete cascade
);





/*bulk message*/
create table if not exists bulk_message(
    id bigint not null auto_increment primary key,
    creator bigint,
    code varchar(191) not null unique,
    title varchar(191),
    description text,
    type enum('sms', 'email'),
    queued boolean default false,
    date_to_send timestamp,
    created_at timestamp default current_timestamp,
    updated_at timestamp default null,
    deleted_at timestamp default null,
    foreign key(creator) references user(id) on delete cascade
);

create table if not exists bulk_message_attachment(
    id bigint not null auto_increment primary key,
    code varchar(191) not null unique,
    bulk_message_id bigint not null,
    download_id bigint,
    file_id bigint,
    created_at timestamp default current_timestamp,
    updated_at timestamp default null,
    deleted_at timestamp default null,
    foreign key(file_id) references file(id) on delete cascade,
    foreign key(bulk_message_id) references bulk_message(id) on delete cascade
);

create table if not exists bulk_message_recipient(
    id bigint not null auto_increment primary key,
    user_id bigint,
    bulk_message_id bigint not null,
    recipient varchar(191) not null,
    created_at timestamp default current_timestamp,
    foreign key(bulk_message_id) references bulk_message(id) on delete cascade,
    foreign key(user_id) references user(id) on delete cascade
);


/** initial insert */

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
        'auditor',
        '2706c21afaae744b4ab494b963a10995',
        now()
    );


insert into
    admin(
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
        'John',
        'Doe',
        '$2y$10$G8PKzvTdpFsDuo14rYuWSedqd85WH93rQ0dElSN.3/azMNIhYT6oK',
        true,
        1,
        'support',
        now()
    );

commit;
