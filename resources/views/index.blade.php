@foreach ($data as $user)

    <h2>{{ $user->name }} posts</h2>

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
            @foreach ($user->postData as $post)
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
