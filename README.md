# Blog App 

1. Created a Laravel blog app using Filament v5 as admin panel
2. Designed database with MySQL (Aiven Cloud) then migrated to local
- Built models with relationships:
Category → One to Many → Posts
Post → Many to Many → Tags (pivot table post_tag)
Created Filament Resources for Posts, Categories, Tags, Users
Handled image uploads using Spatie Media Library plugin
Added slug auto-generation from title using afterStateUpdated
Used Composite Primary Key ['post_id', 'tag_id'] in pivot table
Managed Many-to-Many relationship between Posts and Tags using belongsToMany with manual pivot table name and foreign keys
Configured authentication with login and registration in Filament panel
Customized redirect after create to return to index page
Added Relation Manager to manage Posts inside Tags resource
Styled tables with searchable, sortable, badge, IconColumn for boolean
Used Section::make() instead of deprecated Card::make() in Filament v5
Fixed multiple issues related to Filament v4 vs v5 syntax differences
Customized brand name, logo, and favicon in admin panel
