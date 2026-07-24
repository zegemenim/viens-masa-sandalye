<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class Settings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?int $navigationSort = 100;

    public static function getNavigationIcon(): string
    {
        return 'heroicon-o-cog-6-tooth';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Ayarlar';
    }

    public function getTitle(): string
    {
        return 'Site Ayarları';
    }

    public static function getNavigationLabel(): string
    {
        return 'Site Ayarları';
    }

    protected string $view = 'filament.pages.settings';

    public ?array $data = [];

    public function mount(): void
    {
        $settings = SiteSetting::all()->pluck('value', 'key')->toArray();
        $this->form->fill($settings);
    }

    public function form(Schema $schema): Schema
    {
        $groups = SiteSetting::select('group')->distinct()->pluck('group')->filter()->toArray();
        $tabs = [];

        foreach ($groups as $groupName) {
            $settingsInGroup = SiteSetting::where('group', $groupName)->get();
            $fields = [];
            foreach ($settingsInGroup as $setting) {
                $fields[] = static::getFieldForSetting($setting);
            }
            $tabs[] = Tabs\Tab::make($groupName)->schema($fields);
        }

        // Catch-all for no group
        $ungroupedSettings = SiteSetting::whereNull('group')->orWhere('group', '')->get();
        if ($ungroupedSettings->count() > 0) {
            $fields = [];
            foreach ($ungroupedSettings as $setting) {
                $fields[] = static::getFieldForSetting($setting);
            }
            $tabs[] = Tabs\Tab::make('Diğer')->schema($fields);
        }

        return $schema
            ->components([
                Tabs::make('Ayarlar')
                    ->tabs($tabs)
                    ->columnSpanFull(),
            ])
            ->statePath('data');
    }

    protected static function getFieldForSetting(SiteSetting $setting)
    {
        $key = $setting->key;
        $label = str_replace('_', ' ', Str::title($key));
        
        if (Str::contains($key, ['image', 'logo', 'favicon', 'path'])) {
            return FileUpload::make($key)
                ->label($label)
                ->directory('site-settings')
                ->image();
        }

        if (Str::contains($key, ['video'])) {
            return FileUpload::make($key)
                ->label($label)
                ->directory('site-settings')
                ->acceptedFileTypes(['video/mp4', 'video/webm', 'video/ogg']);
        }

        if (Str::contains($key, ['desc', 'story', 'mission', 'vision', 'about', 'values', 'address', 'title', 'subtitle', 'keywords'])) {
            return Textarea::make($key)
                ->label($label)
                ->rows(3);
        }

        return TextInput::make($key)
            ->label($label)
            ->maxLength(255);
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Kaydet')
                ->submit('save')
                ->color('primary'),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach ($data as $key => $value) {
            SiteSetting::where('key', $key)->update(['value' => $value]);
        }
        
        SiteSetting::clearCache();

        Notification::make()
            ->title('Ayarlar başarıyla kaydedildi.')
            ->success()
            ->send();
    }
}
