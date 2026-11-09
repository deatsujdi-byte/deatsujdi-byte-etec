using System.Threading;
using System.Threading.Tasks;

namespace combustivel.Services
{
    public record FuelPrices(decimal Gasoline, decimal Ethanol);

    public interface IFuelPriceService
    {
        Task<FuelPrices?> GetPricesAsync(CancellationToken cancellationToken = default);
    }
}
