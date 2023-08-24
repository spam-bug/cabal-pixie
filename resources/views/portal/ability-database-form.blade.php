<x-card.form>
    <x-slot name="header">
        <x-card.title>Database Seeder</x-card.title>
        <x-card.description>
            Upload <em>Ability.dec</em> to populate or overwrite database. The data get from
            this file will be use to generate new <em>Ability.dec</em> and <em>Ability.scp</em> files.
        </x-card.description>
    </x-slot>

    <x-slot name="content">
        <x-input.file />
    </x-slot>

    <x-slot name="footer">
        <x-button type="submit" theme="primary" alignment="right">
            Seed Now
        </x-button>
    </x-slot>
</x-card.form>