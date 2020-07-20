using Microsoft.Owin;
using Owin;

[assembly: OwinStartupAttribute(typeof(CineLib.Startup))]
namespace CineLib
{
    public partial class Startup
    {
        public void Configuration(IAppBuilder app)
        {
            ConfigureAuth(app);
        }
    }
}
