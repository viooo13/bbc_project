import os
import glob
import re

css = '''        /* -- Action Buttons -- */
        .action-buttons {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
            align-items: center;
        }

        .btn-sm {
            width: 30px;
            height: 30px;
            padding: 0;
            border: 1px solid transparent;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            text-decoration: none;
            color: #475569;
            background: #f8fafc;
            border-color: #e2e8f0;
        }
        .btn-sm:hover { transform: translateY(-1px); box-shadow: 0 4px 10px rgba(0,0,0,0.06); }
        .btn-sm.has-text { width: auto; padding: 0 12px; gap: 6px; font-weight: 600; font-size: 12px; }

        .btn-view { background: #f8fafc; color: #475569; border-color: #e2e8f0; }
        .btn-view:hover { background: #f1f5f9; color: #0f172a; border-color: #cbd5e1; }

        .btn-edit { background: #eff6ff; color: #2563eb; border-color: #dbeafe; }
        .btn-edit:hover { background: #dbeafe; color: #1d4ed8; border-color: #bfdbfe; }

        .btn-delete { background: #fef2f2; color: #dc2626; border-color: #fee2e2; }
        .btn-delete:hover { background: #fee2e2; color: #b91c1c; border-color: #fca5a5; }

        .btn-confirm { background: #ecfdf5; color: #059669; border-color: #d1fae5; }
        .btn-confirm:hover { background: #d1fae5; color: #047857; border-color: #a7f3d0; }

        .btn-reject { background: #fef2f2; color: #dc2626; border-color: #fee2e2; }
        .btn-reject:hover { background: #fee2e2; color: #b91c1c; border-color: #fca5a5; }

        .btn-ship { background: #fffbeb; color: #d97706; border-color: #fef3c7; }
        .btn-ship:hover { background: #fef3c7; color: #b45309; border-color: #fde68a; }

        .btn-paid { background: #f0fdf4; color: #16a34a; border-color: #dcfce7; }
        .btn-paid:hover { background: #dcfce7; color: #15803d; border-color: #bbf7d0; }

        .btn-complete { background: #eff6ff; color: #2563eb; border-color: #dbeafe; }
        .btn-complete:hover { background: #dbeafe; color: #1d4ed8; border-color: #bfdbfe; }
'''

files = glob.glob(r'c:\bbc_project\resources\views\admin\**\index.blade.php', recursive=True)
files += glob.glob(r'c:\bbc_project\resources\views\admin\pesanan\show.blade.php', recursive=True)

for path in files:
    with open(path, 'r', encoding='utf-8') as f:
        content = f.read()

    # Find the CSS block for action buttons. Usually starts with .action-buttons and ends before /* -- or </style>
    # Since we can't reliably predict the exact end, we'll try to match specific known classes.
    # We will replace from .action-buttons { to the end of the last btn-* hover definition.
    pattern = re.compile(r'\.action-buttons\s*\{.*?(?:\.btn-(?:delete|complete|edit|view|confirm|reject|paid|ship):hover\s*\{[^\}]*\}|\.btn-(?:delete|complete|edit|view|confirm|reject|paid|ship)\s*\{[^\}]*\})*', re.DOTALL)
    
    # We also need to add .has-text class to buttons that contain text.
    # But wait, it's safer to just do a smart regex replace on the buttons.
    new_content = pattern.sub(css.strip(), content)
    
    # Let's also add .has-text class to buttons that have text.
    # Pattern to find: <button class="btn-sm btn-confirm"...><i class="..."></i> Text</button>
    new_content = re.sub(r'(<button[^>]+class="[^"]*btn-sm[^"]*"[^>]*>)\s*<i[^>]+>\s*</i>\s*(?=[a-zA-Z])', r'\1 <i class="..."></i>', new_content)
    
    # A safer way to add has-text:
    new_content = re.sub(r'class="([^"]*btn-sm[^"]*)"([^>]*)>(.*?[a-zA-Z].*?)</button>', r'class="\1 has-text"\2>\3</button>', new_content)
    new_content = re.sub(r'class="([^"]*btn-sm[^"]*)"([^>]*)>(.*?[a-zA-Z].*?)</a>', r'class="\1 has-text"\2>\3</a>', new_content)
    
    # Actually, we don't need has-text if we just use a more forgiving CSS for .btn-sm:
    # Wait, if btn-sm has fixed width/height, text will overflow. 
    # Let's fix the CSS in the python script to automatically handle text vs no-text by using :not(:empty) or similar, or just modifying the inline-flex.

    with open(path, 'w', encoding='utf-8') as f:
        f.write(new_content)

print('Updated files.')
