<div>
    <form wire:submit.prevent="generarPdf" style="display: inline" target="_blank">
        <input type="hidden" wire:model="codigo_id" value="{{ $codigo_id}}">
        <button type="submit">Generar PDF</button>
    </form>    
</div>
