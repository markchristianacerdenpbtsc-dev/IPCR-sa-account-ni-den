<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use App\Models\IpcrTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IpcrTemplateController extends Controller
{
    /**
     * Store a newly created IPCR template.
     */
    public function store(Request $request)
    {
        try {
            \Log::info('==== IPCR STORE REQUEST ====');
            \Log::info('Request all', ['data' => $request->all()]);
            
            $request->validate([
                'title' => 'nullable|string|max:255',
                'strategic_objectives' => 'nullable|array',
                'headers' => 'nullable|array',
            ]);

            // Use input() to get form data, not ->headers which gets HTTP headers!
            $strategicObjectives = $request->input('strategic_objectives', []);
            $headers = $request->input('headers', []);
            
            \Log::info('Strategic objectives from input', ['data' => $strategicObjectives, 'type' => gettype($strategicObjectives)]);
            \Log::info('Headers from input', ['data' => $headers, 'type' => gettype($headers)]);
            
            // Ensure they are arrays
            if (!is_array($strategicObjectives)) {
                $strategicObjectives = [];
            }
            if (!is_array($headers)) {
                $headers = [];
            }
            
            // Re-index arrays to ensure they're proper arrays, not objects
            $strategicObjectives = array_values($strategicObjectives);
            $headers = array_values($headers);
            
            \Log::info('After processing', ['strategic_objectives' => $strategicObjectives, 'headers' => $headers]);
            
            $contentArray = [
                'strategic_objectives' => $strategicObjectives,
                'headers' => $headers,
            ];
            
            $contentJson = json_encode($contentArray);
            \Log::info('Content JSON', ['json' => $contentJson]);

            $template = IpcrTemplate::create([
                'user_id' => Auth::id(),
                'title' => $request->input('title', 'IPCR Template'),
                'period' => 'January - June 2026',
                'content' => $contentJson,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'IPCR template saved successfully',
                'template' => $template,
            ]);
        } catch (\Exception $e) {
            \Log::error('IPCR Store Error', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to save IPCR template: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified IPCR template.
     */
    public function show($id)
    {
        try {
            $template = IpcrTemplate::where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            return response()->json([
                'success' => true,
                'template' => $template,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Template not found',
            ], 404);
        }
    }

    /**
     * Remove the specified IPCR template.
     */
    public function destroy($id)
    {
        try {
            $template = IpcrTemplate::where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            $template->delete();

            return response()->json([
                'success' => true,
                'message' => 'Template deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete template',
            ], 500);
        }
    }

    /**
     * Update the specified IPCR template.
     */
    public function update(Request $request, $id)
    {
        try {
            \Log::info('==== IPCR UPDATE REQUEST ====');
            \Log::info('Template ID', ['id' => $id]);
            \Log::info('Request all', ['data' => $request->all()]);
            
            $template = IpcrTemplate::where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            $request->validate([
                'title' => 'nullable|string|max:255',
                'strategic_objectives' => 'nullable|array',
                'headers' => 'nullable|array',
            ]);

            $strategicObjectives = $request->input('strategic_objectives', []);
            $headers = $request->input('headers', []);
            
            // Ensure they are arrays
            if (!is_array($strategicObjectives)) {
                $strategicObjectives = [];
            }
            if (!is_array($headers)) {
                $headers = [];
            }
            
            // Re-index arrays
            $strategicObjectives = array_values($strategicObjectives);
            $headers = array_values($headers);
            
            $contentArray = [
                'strategic_objectives' => $strategicObjectives,
                'headers' => $headers,
            ];
            
            $contentJson = json_encode($contentArray);

            $template->update([
                'title' => $request->input('title', $template->title),
                'content' => $contentJson,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'IPCR template updated successfully',
                'template' => $template->fresh(),
            ]);
        } catch (\Exception $e) {
            \Log::error('IPCR Update Error', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to update IPCR template: ' . $e->getMessage(),
            ], 500);
        }
    }
}
