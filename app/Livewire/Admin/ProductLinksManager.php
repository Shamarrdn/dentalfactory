<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\ProductLink;

class ProductLinksManager extends Component
{
    public $links = [];
    public $productId = null;

    protected $rules = [
        'links.*.url' => 'required|string|max:255',
        'links.*.caption' => 'required|string|max:255',
        'links.*.description' => 'nullable|string|max:1000',
    ];

    protected $messages = [
        'links.*.url.required' => 'URL مطلوب',
        'links.*.url.max' => 'URL يجب أن يكون أقل من 255 حرف',
        'links.*.caption.required' => 'العنوان مطلوب',
        'links.*.caption.max' => 'العنوان يجب أن يكون أقل من 255 حرف',
        'links.*.description.max' => 'الوصف يجب أن يكون أقل من 1000 حرف',
    ];

    public function mount($productId = null, $existingLinks = [])
    {
        $this->productId = $productId;
        
        if (!empty($existingLinks)) {
            $this->links = $existingLinks;
        } else {
            // Start with one empty link
            $this->addLink();
        }
    }

    public function addLink()
    {
        $this->links[] = [
            'url' => '',
            'caption' => '',
            'description' => '',
        ];
    }

    public function removeLink($index)
    {
        if (count($this->links) > 1) {
            unset($this->links[$index]);
            $this->links = array_values($this->links); // Re-index array
        }
    }

    public function validateLinks()
    {
        $this->validate();
        
        // Filter out empty links (links where both URL and caption are empty)
        $this->links = array_filter($this->links, function($link) {
            return !empty(trim($link['url'])) || !empty(trim($link['caption']));
        });
        
        // Re-index the array
        $this->links = array_values($this->links);
        
        return $this->links;
    }

    public function getLinksData()
    {
        // Force validation and return clean data
        $validatedLinks = $this->validateLinks();
        
        // Log the final data for debugging
        \Log::info('ProductLinksManager - Final Links Data:', $validatedLinks);
        
        return $validatedLinks;
    }

    public function hydrateLinksForSubmission()
    {
        // This method can be called before form submission to ensure data is ready
        $this->validateLinks();
        $this->dispatch('links-validated', $this->links);
    }

    public function updated($propertyName)
    {
        // Real-time validation for specific fields
        if (str_contains($propertyName, '.url')) {
            $this->validateOnly($propertyName);
            
            // Auto-format URL if it doesn't start with http/https
            $index = explode('.', $propertyName)[1];
            $url = $this->links[$index]['url'] ?? '';
            
            if (!empty($url) && !preg_match("~^(?:f|ht)tps?://~i", $url)) {
                // Don't auto-add https while user is typing
                if (strlen($url) > 5 && !str_ends_with($url, '.')) {
                    $this->links[$index]['url'] = "https://" . $url;
                }
            }
        }
        
        if (str_contains($propertyName, '.caption')) {
            $this->validateOnly($propertyName);
        }
        
        if (str_contains($propertyName, '.description')) {
            $this->validateOnly($propertyName);
        }
    }

    public function formatUrl($index)
    {
        $url = $this->links[$index]['url'] ?? '';
        if (!empty($url) && !preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $this->links[$index]['url'] = "https://" . $url;
        }
    }

    public function render()
    {
        return view('livewire.admin.product-links-manager');
    }
}
