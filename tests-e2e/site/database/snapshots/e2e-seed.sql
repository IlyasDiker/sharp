PRAGMA foreign_keys=OFF;
BEGIN TRANSACTION;
CREATE TABLE IF NOT EXISTS "migrations" ("id" integer primary key autoincrement not null, "migration" varchar not null, "batch" integer not null);
INSERT INTO migrations VALUES(1,'0001_01_01_000000_create_users_table',1);
INSERT INTO migrations VALUES(2,'0001_01_01_000001_create_cache_table',1);
INSERT INTO migrations VALUES(3,'2024_12_02_074049_create_test_models_table',1);
INSERT INTO migrations VALUES(4,'2024_12_03_131205_create_medias_table',1);
INSERT INTO migrations VALUES(5,'2025_01_28_120246_create_test_tags_table',1);
CREATE TABLE IF NOT EXISTS "users" ("id" integer primary key autoincrement not null, "name" varchar not null, "email" varchar not null, "email_verified_at" datetime, "password" varchar not null, "remember_token" varchar, "created_at" datetime, "updated_at" datetime);
INSERT INTO users VALUES(1,'Test User','test@example.org','2025-02-04 09:44:30','$2y$12$DRp2sinCYxbQk.i/XfseE.miApJPgJFGwzs8CMPbcHLT.4TTLyUkC','mAvCcdwAUc','2025-02-04 09:44:31','2025-02-04 09:44:31');
CREATE TABLE IF NOT EXISTS "password_reset_tokens" ("email" varchar not null, "token" varchar not null, "created_at" datetime, primary key ("email"));
CREATE TABLE IF NOT EXISTS "sessions" ("id" varchar not null, "user_id" integer, "ip_address" varchar, "user_agent" text, "payload" text not null, "last_activity" integer not null, primary key ("id"));
CREATE TABLE IF NOT EXISTS "cache" ("key" varchar not null, "value" text not null, "expiration" integer not null, primary key ("key"));
CREATE TABLE IF NOT EXISTS "cache_locks" ("key" varchar not null, "owner" varchar not null, "expiration" integer not null, primary key ("key"));
CREATE TABLE IF NOT EXISTS "test_models" ("id" integer primary key autoincrement not null, "autocomplete_local" integer, "autocomplete_remote" integer, "autocomplete_remote2" integer, "autocomplete_list" text, "check" tinyint(1), "date" date, "date_time" datetime, "time" time, "editor_html" text, "editor_html_localized" text, "editor_markdown" text, "geolocation" text, "list" text, "number" integer, "select_dropdown" integer, "select_dropdown_multiple" text, "select_checkboxes" text, "select_radio" integer, "textarea" text, "textarea_localized" text, "text" varchar, "text_localized" text, "upload_id" integer, "order" integer not null default '100', "state" varchar not null default 'draft', "created_at" datetime, "updated_at" datetime);
CREATE TABLE IF NOT EXISTS "medias" ("id" integer primary key autoincrement not null, "model_type" varchar not null, "model_id" integer not null, "model_key" varchar, "file_name" varchar, "mime_type" varchar, "disk" varchar default 'local', "size" integer, "custom_properties" text, "order" integer, "created_at" datetime, "updated_at" datetime);
CREATE TABLE IF NOT EXISTS "test_tags" ("id" integer primary key autoincrement not null, "label" varchar not null, "created_at" datetime, "updated_at" datetime);
CREATE TABLE IF NOT EXISTS "test_model_test_tag" ("id" integer primary key autoincrement not null, "test_model_id" integer not null, "test_tag_id" integer not null, "created_at" datetime, "updated_at" datetime, foreign key("test_model_id") references "test_models"("id") on delete cascade, foreign key("test_tag_id") references "test_tags"("id") on delete cascade);
DELETE FROM sqlite_sequence;
INSERT INTO sqlite_sequence VALUES('migrations',5);
INSERT INTO sqlite_sequence VALUES('users',1);
CREATE UNIQUE INDEX "users_email_unique" on "users" ("email");
CREATE INDEX "sessions_user_id_index" on "sessions" ("user_id");
CREATE INDEX "sessions_last_activity_index" on "sessions" ("last_activity");
CREATE INDEX "medias_model_type_model_id_index" on "medias" ("model_type", "model_id");
COMMIT;
