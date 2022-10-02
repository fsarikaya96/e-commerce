<?php

namespace App\Http\Livewire\Admin\Color;

use App\Models\Color;
use App\Services\Admin\Interfaces\IColorService;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'bootstrap';

    public $name, $code, $status, $color_id, $colorInput;

    private IColorService $colorService;

    /**
     * Color construct
     *
     * @param IColorService $IColorService
     */
    public function boot(IColorService $IColorService)
    {
        $this->colorService = $IColorService;
    }

    public function rules()
    {
        return Color::rules();
    }

    public function closeModal()
    {
        $this->resetForm();
    }

    public function openModal()
    {
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->name       = null;
        $this->code       = null;
        $this->colorInput = null;
        $this->status     = null;
        $this->color_id   = null;
    }

    public function storeColor(Color $color)
    {
        $validatedData = $this->validate();
        $data          = $color->fill($validatedData);
        $this->colorService->create($data);

        session()->flash('livewire_message', 'Renk Başarıyla Oluşturuldu.');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetForm();
    }

    public function editColor($color_id)
    {
        $this->color_id   = $color_id;
        $color            = $this->colorService->getColorById($color_id);
        $this->name       = $color->name;
        $this->code       = $color->code;
        $this->colorInput = $color->code;
        $this->status     = $color->status;
    }

    public function updateColor()
    {
        $validatedData = $this->validate();
        $color         = $this->colorService->getColorById($this->color_id);
        $data          = $color->fill($validatedData);
        $this->colorService->update($data, $this->color_id);
        session()->flash('livewire_message', 'Renk Başarıyla Güncellendi.');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetForm();
    }

    public function deleteColor($color_id)
    {
        $this->color_id = $color_id;
    }

    public function destroyColor()
    {
        Color::findOrFail($this->color_id)->delete();
        session()->flash('livewire_message', 'Renk Başarıyla Silindi.');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetForm();
    }

    public function render()
    {
        $colors = $this->colorService->getAllColors();

        return view('livewire.admin.color.index', ['colors' => $colors]);
    }
}
