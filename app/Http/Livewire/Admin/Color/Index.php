<?php

namespace App\Http\Livewire\Admin\Color;

use App\Models\Color;
use Livewire\Component;

class Index extends Component
{
    public $name, $code, $status, $color_id;

    public function render()
    {
        $colors = Color::all();
        return view('livewire.admin.color.index',['colors' => $colors]);
    }

    public function rules()
    {
        return [
            'name'   => 'required|string',
            'code'   => 'required|string',
            'status' => 'nullable',
        ];
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
        $this->name   = null;
        $this->code   = null;
        $this->status = null;
        $this->color_id = null;
    }

    public function storeColor()
    {
        $this->validate();
        Color::create([
            'name'   => $this->name,
            'code'   => $this->code,
            'status' => $this->status ? "1" : "0"
        ]);
        session()->flash('livewire_message', 'Renk Başarıyla Oluşturuldu.');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetForm();
    }

    public function editColor($color_id)
    {
        $this->color_id = $color_id;
        $color = Color::findOrFail($color_id);
        $this->name = $color->name;
        $this->code = $color->code;
        $this->status = $color->status;
    }
    public function updateColor()
    {
        $this->validate();
        Color::findOrFail($this->color_id)->update([
            'name' => $this->name,
            'code' => $this->code,
            'status' => $this->status,
        ]);
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
}
