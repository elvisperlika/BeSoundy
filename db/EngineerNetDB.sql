-- Crea il DB
CREATE DATABASE IF NOT EXISTS EngineerNet;

-- Usa il database creato
USE EngineerNet;

create or replace table user
(
    username   varchar(200)  not null
        primary key,
    email      varchar(200)  not null,
    imgProfile blob          null,
    password   varchar(50)   not null,
    name       varchar(100)  null,
    bio        varchar(400)  null,
    nPost      int default 0 null,
    nFollower  int default 0 null,
    nFollowing int default 0 null,
    constraint user_pk_2
        unique (email)
);

create or replace table post
(
    text     varchar(200)                          null,
    image    blob                                  not null,
    username varchar(200)                          null,
    nLike    int       default 0                   null,
    nComment int       default 0                   null,
    idPost   int auto_increment
        primary key,
    time     timestamp default current_timestamp() null,
    constraint post_user_username_fk
        foreign key (username) references engineernet.user (username)
);

create or replace table comment
(
    text      varchar(400)                          not null,
    idComment int auto_increment
        primary key,
    user      varchar(200)                          null,
    post      int                                   null,
    nLike     int       default 0                   null,
    time      timestamp default current_timestamp() null,
    constraint comment_post_idPost_fk
        foreign key (post) references engineernet.post (idPost),
    constraint comment_user_username_fk
        foreign key (user) references engineernet.user (username)
);

create or replace table follow
(
    follower varchar(200) not null,
    followed varchar(200) not null,
    constraint follow_pk
        unique (followed, follower),
    constraint follow_user_username_fk
        foreign key (follower) references engineernet.user (username),
    constraint follow_user_username_fk_2
        foreign key (followed) references engineernet.user (username),
    constraint check_not_self_follow
        check (follow.followed not like follow.follower)
);

create or replace table like_comment
(
    user    varchar(200)                          null,
    comment int                                   null,
    time    timestamp default current_timestamp() null,
    constraint like_comment_comment_idComment_fk
        foreign key (comment) references engineernet.comment (idComment),
    constraint like_comment_user_username_fk
        foreign key (user) references engineernet.user (username)
);

create or replace table like_post
(
    post int                                   null,
    user varchar(200)                          null,
    time timestamp default current_timestamp() null,
    constraint like_post_post_idPost_fk
        foreign key (post) references engineernet.post (idPost),
    constraint like_user_username_fk
        foreign key (user) references engineernet.user (username)
);

