using System;
using System.ComponentModel;
using System.Runtime.CompilerServices;
using System.Threading.Tasks;
using System.Windows.Input;
using combustivel.Services;

namespace combustivel.ViewModels
{
    public class RelayCommand : ICommand
    {
        private readonly Func<Task> _execute;
        private readonly Func<bool>? _canExecute;

        public RelayCommand(Func<Task> execute, Func<bool>? canExecute = null)
        {
            _execute = execute;
            _canExecute = canExecute;
        }

        public event EventHandler? CanExecuteChanged;

        public bool CanExecute(object? parameter) => _canExecute?.Invoke() ?? true;

        public async void Execute(object? parameter) => await _execute();

        public void RaiseCanExecuteChanged() => CanExecuteChanged?.Invoke(this, EventArgs.Empty);
    }

    public class FuelViewModel : INotifyPropertyChanged
    {
        private readonly IFuelPriceService _priceService;

        public FuelViewModel(IFuelPriceService priceService)
        {
            _priceService = priceService;
            FetchAndCalculateCommand = new RelayCommand(FetchAndCalculateAsync);
            FuelTypes = new[] { "Gasolina", "Etanol" };
            SelectedFuelIndex = 0;
        }

        public event PropertyChangedEventHandler? PropertyChanged;

        private void Raise([CallerMemberName] string? name = null) => PropertyChanged?.Invoke(this, new PropertyChangedEventArgs(name));

        public string[] FuelTypes { get; }

        private string _distance = "";
        public string Distance { get => _distance; set { _distance = value; Raise(); } }

        private string _consumption = ""; // km per liter
        public string Consumption { get => _consumption; set { _consumption = value; Raise(); } }

        private string _vehicleBrand = "";
        public string VehicleBrand { get => _vehicleBrand; set { _vehicleBrand = value; Raise(); } }

        private string _vehicleModel = "";
        public string VehicleModel { get => _vehicleModel; set { _vehicleModel = value; Raise(); } }

        private int _selectedFuelIndex;
        public int SelectedFuelIndex { get => _selectedFuelIndex; set { _selectedFuelIndex = value; Raise(); } }

        private decimal? _gasolinePrice;
        public decimal? GasolinePrice { get => _gasolinePrice; set { _gasolinePrice = value; Raise(); } }

        private decimal? _ethanolPrice;
        public decimal? EthanolPrice { get => _ethanolPrice; set { _ethanolPrice = value; Raise(); } }

        private string _result = "";
        public string Result { get => _result; set { _result = value; Raise(); } }

        public ICommand FetchAndCalculateCommand { get; }

        private async Task FetchAndCalculateAsync()
        {
            Result = "Usando preços fixos: Gasolina R$6,00, Etanol R$4,00";
            var prices = await _priceService.GetPricesAsync();
            if (prices is null)
            {
                Result = "Não foi possível obter os preços. Tente novamente ou insira os preços manualmente.";
                return;
            }

            GasolinePrice = prices.Gasoline;
            EthanolPrice = prices.Ethanol;

            if (!decimal.TryParse(Consumption, out var consumption) || consumption <= 0)
            {
                Result = "Insira um consumo válido (km por litro).";
                return;
            }

            if (!decimal.TryParse(Distance, out var distance) || distance <= 0)
            {
                Result = "Insira uma distância válida.";
                return;
            }

            var litersNeeded = distance / consumption;

            // compute cost per km for both fuels
            var costPerKmGas = (GasolinePrice ?? 0m) / consumption;
            var costPerKmEth = (EthanolPrice ?? 0m) / consumption;

            decimal pricePerLiter = SelectedFuelIndex == 0 ? GasolinePrice ?? 0 : EthanolPrice ?? 0;
            var totalCost = litersNeeded * pricePerLiter;
            var costPerKm = totalCost / distance;

            var bestFuel = costPerKmEth < costPerKmGas ? "etanol" : "gasolina";

            Result = $"Combustível: {FuelTypes[SelectedFuelIndex]}\nDistância: {distance} km\nConsumo: {consumption} km/l\nLitros necessários: {litersNeeded:F2} L\nCusto total: R$ {totalCost:F2}\nCusto por km: R$ {costPerKm:F2}\n\nO {bestFuel} está compensando para o seu {VehicleBrand} {VehicleModel}.";
        }
    }
}
