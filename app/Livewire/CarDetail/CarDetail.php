<?php

namespace App\Livewire\CarDetail;

use App\Models\CarModel;
use Livewire\Component;

class CarDetail extends Component
{
    public CarModel $car;
    public $selectedTransmission = 'all';
    public $selectedType = null;
    public $selectedColor = null;
    public $expandedSections = [];

    protected $queryString = [
        'selectedTransmission' => ['except' => 'all'],
        'selectedType' => ['except' => null],
    ];

    public function mount(CarModel $car)
    {
        $this->car = $car;
        $this->selectedColor = $this->car->carColors->first();
        $this->selectedType = $this->car->activeCarTypes->first();
        
        // Start with all sections collapsed
        $this->expandedSections = [];
    }

    public function getFilteredTypesProperty()
    {
        $types = $this->car->activeCarTypes;

        if ($this->selectedTransmission !== 'all') {
            $types = $types->where('transmission', $this->selectedTransmission);
        }

        return $types->values();
    }

    public function getAvailableTransmissionsProperty()
    {
        return $this->car->activeCarTypes
            ->pluck('transmission')
            ->unique()
            ->sort()
            ->values();
    }

    public function getSpecificationsProperty()
    {
        $specs = [];
        
        if ($this->selectedType) {
            $specs = $this->selectedType->specifications ?? [];
        }

        // Ensure all required sections exist
        return [
            'dimensions' => $specs['dimensions'] ?? $this->getDummyDimensions(),
            'chassis' => $specs['chassis'] ?? $this->getDummyChassis(),
            'engine' => $specs['engine'] ?? $this->getDummyEngine(),
            'safety' => $specs['safety'] ?? $this->getDummySafety(),
            'comfort' => $specs['comfort'] ?? $this->getDummyComfort(),
            'additional' => $specs['additional'] ?? $this->getDummyAdditional(),
        ];
    }

    public function selectColor($colorId)
    {
        $this->selectedColor = $this->car->carColors->find($colorId);
    }

    public function selectType($typeId)
    {
        $this->selectedType = $this->car->activeCarTypes->find($typeId);
        $this->selectedTransmission = $this->selectedType->transmission ?? 'all';
    }

    public function selectTransmission($transmission)
    {
        $this->selectedTransmission = $transmission;
        
        // Auto-select first available type for this transmission
        $firstType = $this->filteredTypes->first();
        if ($firstType) {
            $this->selectedType = $firstType;
        }
    }

    public function toggleSection($section)
    {
        if (in_array($section, $this->expandedSections)) {
            $this->expandedSections = array_diff($this->expandedSections, [$section]);
        } else {
            $this->expandedSections[] = $section;
        }
    }

    public function isSectionExpanded($section)
    {
        return in_array($section, $this->expandedSections);
    }

    // Dummy data methods for fallback
    private function getDummyDimensions()
    {
        return [
            'Panjang' => '4.435 mm',
            'Lebar' => '1.695 mm',
            'Tinggi' => '1.680 mm',
            'Jarak Poros Roda' => '2.650 mm',
            'Jarak Terendah' => '200 mm',
            'Jarak Pijak Depan' => '1.470 mm',
            'Jarak Pijak Belakang' => '1.470 mm',
        ];
    }

    private function getDummyChassis()
    {
        return [
            'Transmisi' => $this->selectedType?->transmission_label ?? 'Manual',
            'Perbandingan Gigi 1' => '3.545',
            'Perbandingan Gigi 2' => '1.904',
            'Perbandingan Gigi 3' => '1.310',
            'Perbandingan Gigi 4' => '0.969',
            'Perbandingan Gigi 5' => '0.816',
            'Perbandingan Gigi 6' => '-',
            'Perbandingan Gigi Mundur' => '3.583',
            'Perbandingan Gigi Akhir' => '4.313',
            'Suspensi Depan' => 'MacPherson Strut dengan Stabilizer',
            'Suspensi Belakang' => 'Multi-link dengan Stabilizer',
            'Rem Depan' => 'Ventilated Disc',
            'Rem Belakang' => 'Solid Disc',
            'Ukuran Ban' => '205/65 R16',
        ];
    }

    private function getDummyEngine()
    {
        return [
            'Tipe Mesin' => '2NR-VE, DOHC, VVT-i',
            'Isi Silinder' => '1.496 cc',
            'Jumlah Silinder' => '4 Silinder Segaris',
            'Diameter x Langkah' => '72.5 x 90.6 mm',
            'Daya Maksimum' => '104 PS / 6.000 rpm',
            'Torsi Maksimum' => '13.9 Kgm / 4.200 rpm',
            'Sistem Bahan Bakar' => 'EFI (Electronic Fuel Injection)',
            'Kapasitas Tangki' => '45 Liter',
        ];
    }

    private function getDummySafety()
    {
        return [
            'Airbag' => 'SRS Airbag (Depan)',
            'Alarm & Remote' => 'Anti-Theft System dengan Alarm',
            'Lampu Kabut' => 'Front & Rear Fog Lamp',
            'Kontrol Kecepatan' => 'Cruise Control',
            'Immobilizer' => 'Engine Immobilizer',
            'Seatbelt' => '3-Point ELR Seatbelt',
            'Child Safety Lock' => 'Rear Door Child Lock',
            'Parking Sensor' => '4 Sensor Parking',
        ];
    }

    private function getDummyComfort()
    {
        return [
            'Power Seat' => 'Driver Seat Power Adjustable',
            'Jok Kulit' => 'Leather Seat Material',
            'AC' => 'Automatic Climate Control',
            'Monitor LCD' => '7-inch Touchscreen Display',
            'Power Steering' => 'Electric Power Steering',
            'Power Window' => 'All Windows Power',
            'Keyless Entry' => 'Smart Key System',
            'Audio System' => '6 Speaker Audio System',
        ];
    }

    private function getDummyAdditional()
    {
        return [
            'Jumlah Pintu' => '5 Pintu',
            'Kapasitas Penumpang' => '7 Penumpang',
            'Kapasitas Bagasi' => '580 Liter',
            'Body Kit' => 'Full Body Kit',
            'Spion' => 'Electric Mirror with Turn Signal',
            'Wiper' => 'Intermittent Wiper',
            'Lampu Depan' => 'LED Headlamp',
            'Lampu Belakang' => 'LED Rear Combination Lamp',
        ];
    }

    public function render()
    {
        return view('livewire.car-detail.car-detail');
    }
}
