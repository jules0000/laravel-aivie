@if ($paginator->hasPages())
    <nav>
        <ul style="display: flex; list-style: none; gap: 8px; justify-content: center; padding: 0; flex-wrap: wrap;">
            @if ($paginator->onFirstPage())
                <li style="opacity: 0.5;">
                    <span style="padding: 8px 16px; border: 1px solid #e5e7eb; border-radius: 8px; color: #9ca3af; text-decoration: none; display: inline-block;">← Previous</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" style="padding: 8px 16px; border: 1px solid #e5e7eb; border-radius: 8px; color: #374151; text-decoration: none; display: inline-block; transition: all 0.3s;">
                        ← Previous
                    </a>
                </li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li>
                        <span style="padding: 8px 16px; border: 1px solid #e5e7eb; border-radius: 8px; color: #9ca3af; text-decoration: none; display: inline-block;">{{ $element }}</span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <span style="padding: 8px 16px; border: 2px solid #ec4899; background: #ec4899; color: white; border-radius: 8px; text-decoration: none; display: inline-block; font-weight: 600;">{{ $page }}</span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}" style="padding: 8px 16px; border: 1px solid #e5e7eb; border-radius: 8px; color: #374151; text-decoration: none; display: inline-block; transition: all 0.3s;">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" style="padding: 8px 16px; border: 1px solid #ec4899; background: #ec4899; color: white; border-radius: 8px; text-decoration: none; display: inline-block; transition: all 0.3s;">
                        Next →
                    </a>
                </li>
            @else
                <li style="opacity: 0.5;">
                    <span style="padding: 8px 16px; border: 1px solid #e5e7eb; border-radius: 8px; color: #9ca3af; text-decoration: none; display: inline-block;">Next →</span>
                </li>
            @endif
        </ul>
    </nav>
@endif

