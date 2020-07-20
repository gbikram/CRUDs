namespace CineLib.Migrations
{
	using System;
	using System.Data.Entity.Migrations;
	
	public partial class UpdateMembershipsData : DbMigration
	{
		public override void Up()
		{
			Sql("UPDATE MembershipTypes SET Name = 'Pay As You Go' WHERE Id = 0");
			Sql("UPDATE MembershipTypes SET Name = 'Monthly' WHERE Id = 1");
			Sql("UPDATE MembershipTypes SET Name = 'Quarterly' WHERE Id = 2");
			Sql("UPDATE MembershipTypes SET Name = 'Anual' WHERE Id = 3");
		}
		
		public override void Down()
		{
		}
	}
}
