<div>
    <x-filament::section>
        <x-slot name="heading">
            Lançamento de Entrada
        </x-slot>


        <x-filament::input.wrapper>
            <x-filament::input
                type="text"
                wire:model="user_id"
            />
        </x-filament::input.wrapper>

        <x-filament::input.wrapper>
            <x-filament::input
                type="text"
                wire:model="fin_frupo_id"
            />
        </x-filament::input.wrapper>

        <x-filament::input.wrapper>
            <x-filament::input.select wire:model="status">
                <option value="draft">Draft</option>
                <option value="reviewing">Reviewing</option>
                <option value="published">Published</option>
            </x-filament::input.select>
        </x-filament::input.wrapper>

        <x-filament::input.wrapper>
            <x-filament::input
                type="text"
                wire:model="name"
            />
        </x-filament::input.wrapper>
    </x-filament::section>
</div>
