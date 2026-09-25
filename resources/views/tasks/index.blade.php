@extends('layouts.app')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
    <div>
        <h1 style="font-size: 20px; font-weight: 600; color: #f8fafc; margin-bottom: 4px;">My Tasks</h1>
        <p style="font-size: 13px; color: #64748b;">Manage and track your active project deliverables.</p>
    </div>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary">+ Add Task</a>
</div>

<div class="card" style="padding: 0; overflow: hidden; background: rgba(17, 24, 39, 0.6); backdrop-filter: blur(16px); border: 1px solid rgba(255, 255, 255, 0.06); border-radius: 12px;">
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="border-bottom: 1px solid rgba(255, 255, 255, 0.06); background: rgba(255, 255, 255, 0.02);">
                <th style="padding: 14px 20px; font-size: 12px; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em;">Task Name</th>
                <th style="padding: 14px 20px; font-size: 12px; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em;">Description</th>
                <th style="padding: 14px 20px; font-size: 12px; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em;">Due Date</th>
                <th style="padding: 14px 20px; font-size: 12px; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em;">Status</th>
                <th style="padding: 14px 20px; font-size: 12px; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; text-align: right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tasks as $task)
                <tr style="border-bottom: 1px solid rgba(255, 255, 255, 0.04); transition: background 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.02)'" onmouseout="this.style.background='transparent'">
                    <td style="padding: 16px 20px; font-size: 13px; font-weight: 500; color: #f8fafc;">
                        {{ $task->task_name }}
                    </td>
                    <td style="padding: 16px 20px; font-size: 13px; color: #94a3b8; max-width: 250px;">
                        {{ Str::limit($task->description, 50) }}
                    </td>
                    <td style="padding: 16px 20px; font-size: 13px; color: #94a3b8;">
                        {{ $task->due_date ? $task->due_date->format('M d, Y') : '—' }}
                    </td>
                    <td style="padding: 16px 20px;">
                        @php
                            $isCompleted = $task->status === 'Completed';
                            $statusStyle = $isCompleted 
                                ? 'background: rgba(5, 150, 105, 0.15); color: #34d399; border: 1px solid rgba(5, 150, 105, 0.3);' 
                                : 'background: rgba(217, 119, 6, 0.15); color: #fbbf24; border: 1px solid rgba(217, 119, 6, 0.3);';
                        @endphp
                        <span style="font-size: 11px; font-weight: 500; padding: 4px 10px; border-radius: 6px; display: inline-block; {{ $statusStyle }}">
                            {{ $task->status }}
                        </span>
                    </td>
                    <td style="padding: 16px 20px; text-align: right;">
                        <div style="display: inline-flex; align-items: center; gap: 8px;">
                            {{-- Toggle Status Button --}}
                            <form action="{{ route('tasks.updateStatus', $task) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn" style="background: rgba(255, 255, 255, 0.05); color: #cbd5e1; border: 1px solid rgba(255, 255, 255, 0.08); padding: 6px 12px; border-radius: 6px; font-size: 12px; cursor: pointer;">
                                    Mark {{ $task->status === 'Pending' ? 'Completed' : 'Pending' }}
                                </button>
                            </form>

                            {{-- Edit Button --}}
                            <a href="{{ route('tasks.edit', $task) }}" class="btn" style="background: rgba(217, 119, 6, 0.15); color: #fbbf24; border: 1px solid rgba(217, 119, 6, 0.3); padding: 6px 12px; border-radius: 6px; font-size: 12px; text-decoration: none;">
                                Edit
                            </a>

                            {{-- Delete Button --}}
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this task?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn" style="background: rgba(220, 38, 38, 0.15); color: #f87171; border: 1px solid rgba(220, 38, 38, 0.3); padding: 6px 12px; border-radius: 6px; font-size: 12px; cursor: pointer;">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="padding: 48px 20px; text-align: center; color: #64748b; font-size: 13px;">
                        No tasks yet. Click "+ Add Task" to create one.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection