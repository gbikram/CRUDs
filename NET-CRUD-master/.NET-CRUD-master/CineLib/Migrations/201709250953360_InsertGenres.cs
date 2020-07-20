namespace CineLib.Migrations
{
	using System;
	using System.Data.Entity.Migrations;
	
	public partial class InsertGenres : DbMigration
	{
		public override void Up()
		{
			Sql("Insert into Genres(Id, Name) VALUES (0, 'Action')");
			Sql("Insert into Genres(Id, Name) VALUES (1, 'Thriller')");
			Sql("Insert into Genres(Id, Name) VALUES (2, 'Family')");
			Sql("Insert into Genres(Id, Name) VALUES (3, 'Romance')");
			Sql("Insert into Genres(Id, Name) VALUES (4, 'Comedy')");
		}
		
		public override void Down()
		{
		}
	}
}
