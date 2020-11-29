CREATE TABLE public.products(
    id serial primary key,
    product_type_id INT,
    description varchar(255) not null,
    created_at timestamp,
    updated_at timestamp
);
CREATE TABLE public.product_types(
    id serial primary key,
    taxes_id INT NOT NULL,
    description varchar(255) not null,
    created_at timestamp,
    updated_at timestamp
);
CREATE TABLE public.taxes(
    id serial primary key,
    description varchar(255) not null,
    percentage float(20),
    created_at timestamp,
    updated_at timestamp
);

insert into public.taxes(description, percentage) values('imposto 1 ', 1.15);
insert into public.product_types(description, taxes_id) values('Tipo de produto ', 1);
insert into public.products(description, product_type_id) values('Produto 1 ', 1);

