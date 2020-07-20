using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using CineLib.Models;
using CineLib.ViewModels;
using System.Data.Entity;

namespace CineLib.Controllers
{
	public class CustomersController : Controller
	{
		private ApplicationDbContext _context;

		// Constructor
		public CustomersController()
		{
			_context = new ApplicationDbContext();
		}

		protected override void Dispose(bool disposing)
		{
			_context.Dispose();
		}

		// GET: Customers List
		public ActionResult Index()
		{
			var customers = _context.Customers.Include(c => c.MembershipType).ToList();

			return View(customers);
		}
		
		// GET: Customer Details
		public ActionResult Details(int id)
		{
			var customer = _context.Customers.Include(c => c.MembershipType).SingleOrDefault(c => c.Id == id);

			if (customer == null)
			{
				return HttpNotFound();
			}

			return View(customer);
		}
	
		public ActionResult New()
		{
			var membershipTypes = _context.MembershipTypes.ToList();
			var viewModel = new NewCustomerViewModel
			{
				MembershipTypes = membershipTypes
			};

			return View(viewModel);
		}
	}
}