@foreach ($users as $key => $user)

    <h2>{{ $key }} posts</h2>

    <table>
        <thead>
            <tr>
                <th>
                    Title
                </th>
                <th>
                    Attachments
                </th>
                <th>
                    Comments
                </th>
                <th> Comment Attachments

                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user as $item)
                <tr>
                    <td>
                        {{ $item->title }}
                    </td>
                    <td>
                        {{ $item->posts_attachments_count }}
                    </td>
                    <td>
                        {{ $item->comments_count }}
                    </td>
                    <td>
                        {{ $item->comment_attachments_count}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <hr />

@endforeach
