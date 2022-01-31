@foreach ($data as $key => $user)

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
            @foreach ($user as $post)
                <tr>
                    <td>
                        {{ $post->title }}
                    </td>
                    <td>
                        {{ $post->count_attachments }}
                    </td>
                    <td>
                        {{ $post->count_comments }}
                    </td>
                    <td>
                        {{ $post->count_comments_attachments }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <hr />

@endforeach
