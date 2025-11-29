@extends('layouts.app')

@section('content')
<section style="padding: 60px 0; min-height: calc(100vh - 200px);">
    <div class="container">
        <div style="max-width: 900px; margin: 0 auto;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px;">
                <div>
                    <h1 style="font-size: 42px; font-weight: 700; margin-bottom: 8px; color: #1f2937;">My Stories</h1>
                    <p style="font-size: 18px; color: #6b7280;">All your submitted messages</p>
                </div>
                <a href="/" class="btn btn-outline" style="text-decoration: none;">← Back to Home</a>
            </div>

            @if($entries->count() > 0)
                <div style="display: flex; flex-direction: column; gap: 24px;">
                    @foreach($entries as $entry)
                        <div style="background: white; padding: 32px; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                            <p style="font-size: 16px; line-height: 1.8; color: #374151; white-space: pre-wrap; margin-bottom: 16px;">
                                {{ $entry->message }}
                            </p>
                            <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 16px; border-top: 1px solid #e5e7eb;">
                                <span style="font-size: 14px; color: #9ca3af;">
                                    {{ $entry->created_at->format('F d, Y h:i A') }}
                                </span>
                                @if($entry->is_anonymous)
                                    <span style="font-size: 14px; color: #ec4899; background: #fce7f3; padding: 4px 12px; border-radius: 12px;">
                                        Anonymous
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <div style="margin-top: 40px; display: flex; justify-content: center;">
                    {{ $entries->links() }}
                </div>
            @else
                <div style="background: white; padding: 60px; border-radius: 12px; text-align: center; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                    <p style="font-size: 18px; color: #6b7280; margin-bottom: 24px;">
                        You haven't submitted any messages yet.
                    </p>
                    <a href="/" class="btn btn-primary" style="text-decoration: none;">Submit Your First Story</a>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection

