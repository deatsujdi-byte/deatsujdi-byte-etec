using System.Threading;
using System.Threading.Tasks;

namespace combustivel.Services
{
    public class HttpFuelPriceService : IFuelPriceService
    {
        public Task<FuelPrices?> GetPricesAsync(CancellationToken cancellationToken = default)
        {
            return Task.FromResult<FuelPrices?>(new FuelPrices(6.00m, 4.00m));
        }
    }
}
