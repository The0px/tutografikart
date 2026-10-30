<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropertyContactRequest;
use App\Http\Requests\SearchPropertiesRequest;
use App\Jobs\DemoJob;
use App\Models\Property;
use App\Notifications\ContactRequestNotification;
use Illuminate\Support\Facades\Notification;

class PropertyController extends Controller
{
    public function index(SearchPropertiesRequest $request)
    {

        $query = Property::query()->orderBy('created_at', 'desc');
        if ($price = $request->validated('price')) {
            $query = $query->where('price', '<=', $price);

        }
        if ($surface = $request->validated('surface')) {
            $query = $query->where('surface', '>=', $surface);

        }
        if ($rooms = $request->validated('rooms')) {
            $query = $query->where('rooms', '>=', $rooms);

        }
        if ($title = $request->validated('title')) {
            $query = $query->where('title', 'like', "%{$title}%");
        }

        return view('property.index', ['properties' => $query->paginate(16)]);
    }

    public function show(string $slug, Property $property)
    {
        DemoJob::dispatch($property)->delay(now()->addSeconds(10));
        $expectedSlug = $property->getSlug();
        if ($slug !== $property->getSlug()) {
            return to_route('property.show', ['slug' => $expectedSlug, 'property' => $property]);
        }

        return view('property.show', ['property' => $property,

        ]);
    }

    public function contact(Property $property, PropertyContactRequest $request)
    {

        Notification::route('mail', 'john@admin.com')->notify(new ContactRequestNotification($property, $request->validated()));

        return back()->with('success', 'Votre message a été envoyé avec succès');
    }
}
