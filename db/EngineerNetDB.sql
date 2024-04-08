DROP DATABASE IF EXISTS EnginnerNet;

CREATE DATABASE IF NOT EXISTS EnginnerNet;

USE EnginnerNet;

create or replace table alert_
(
    time        timestamp  default current_timestamp()                                          not null on update current_timestamp(),
    type        enum ('LIKE_POST', 'LIKE_COMMENT', 'COMMENT_POST', 'COMMENT_COMMENT', 'FOLLOW') not null,
    idElement   int                                                                             not null,
    sender      varchar(200)                                                                    not null comment 'The user that ''create'' the alert.',
    isAlertRead tinyint(1) default 0                                                            not null,
    receiver    varchar(200)                                                                    null
);

create or replace table comment
(
    text           varchar(400)                          not null,
    idComment      int auto_increment
        primary key,
    user           varchar(200)                          null,
    post           int                                   null,
    nLike          int       default 0                   null,
    time           timestamp default current_timestamp() null,
    parent_comment varchar(200)                          null,
    constraint comment_post_idPost_fk
        foreign key (post) references engineernet.post (idPost),
    constraint comment_user_username_fk
        foreign key (user) references engineernet.user (username)
);

create or replace definer = root@localhost trigger alert_comment_comment_trigger
    after insert
    on comment
    for each row
BEGIN
    IF NEW.parent_comment IS NOT NULL THEN
        INSERT INTO alert_(time, type, idElement, sender, receiver)
        VALUES (CURRENT_TIMESTAMP, 'COMMENT_COMMENT', NEW.idComment, NEW.user, (
            SELECT C.user
            FROM comment C
            where C.idComment = NEW.parent_comment
        ));
    END IF;
END;

create or replace definer = root@localhost trigger alert_comment_post_trigger
    after insert
    on comment
    for each row
BEGIN
    IF NEW.parent_comment IS NULL THEN
        INSERT INTO alert_(time, type, idElement, sender, receiver)
        VALUES (CURRENT_TIMESTAMP, 'COMMENT_POST', NEW.idComment, NEW.user, (
            SELECT post.username
            FROM post
            where post.idPost = NEW.post
        ));
    END IF;
END;

create or replace table follow
(
    follower  varchar(200) not null,
    followed  varchar(200) not null,
    follow_id int auto_increment
        primary key,
    constraint follow_pk
        unique (followed, follower),
    constraint follow_user_username_fk
        foreign key (follower) references engineernet.user (username),
    constraint follow_user_username_fk_2
        foreign key (followed) references engineernet.user (username),
    constraint check_not_self_follow
        check ()
);

create or replace definer = root@localhost trigger alert_follow_trigger
    after insert
    on follow
    for each row
BEGIN
    INSERT INTO alert_(time, type, idElement, sender, receiver)
    VALUES (CURRENT_TIMESTAMP, 'FOLLOW', NEW.follow_id, NEW.follower, NEW.followed);
END;

create or replace table like_comment
(
    user            varchar(200)                          null,
    comment         int                                   null,
    time            timestamp default current_timestamp() null,
    like_comment_id int auto_increment
        primary key,
    constraint like_comment_comment_idComment_fk
        foreign key (comment) references engineernet.comment (idComment),
    constraint like_comment_user_username_fk
        foreign key (user) references engineernet.user (username)
);

create or replace definer = root@localhost trigger alert_like_comment_trigger
    after insert
    on like_comment
    for each row
BEGIN
    INSERT INTO alert_(time, type, idElement, sender, receiver)
    VALUES (CURRENT_TIMESTAMP, 'LIKE_COMMENT', NEW.like_comment_id, NEW.user, (
        SELECT comment.user
        FROM comment
        where comment.idComment = NEW.comment
    ));
END;

create or replace table like_post
(
    post         int                                   null,
    user         varchar(200)                          null,
    time         timestamp default current_timestamp() null,
    like_post_id int auto_increment
        primary key,
    constraint like_post_post_idPost_fk
        foreign key (post) references engineernet.post (idPost),
    constraint like_user_username_fk
        foreign key (user) references engineernet.user (username)
);

create or replace definer = root@localhost trigger alert_like_post_trigger
    after insert
    on like_post
    for each row
BEGIN
    INSERT INTO alert_(time, type, idElement, sender, receiver)
    VALUES (CURRENT_TIMESTAMP, 'LIKE_POST', NEW.like_post_id, NEW.user, (
        SELECT post.username
        FROM post
        where post.idPost = NEW.post
    ));
END;

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

create or replace table user
(
    username   varchar(200)  not null
        primary key,
    email      varchar(200)  not null,
    password   varchar(50)   not null,
    name       varchar(100)  null,
    bio        varchar(400)  null,
    nPost      int default 0 null,
    nFollower  int default 0 null,
    nFollowing int default 0 null,
    imgProfile blob          null,
    constraint user_pk_2
        unique (email)
);


