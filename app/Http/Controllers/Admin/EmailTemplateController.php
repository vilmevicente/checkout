<?php

namespace App\Http\Controllers\Admin;


use App\Models\EmailTemplate;
use Illuminate\Http\Request;

class EmailTemplateController extends Controller
{
    public function index()
    {
        $templates = EmailTemplate::all();
        return view('email_templates.index', compact('templates'));
    }

    public function create()
    {
        return view('email_templates.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:email_templates',
            'subject' => 'required',
            'body' => 'required',
        ]);

        EmailTemplate::create($request->all());

        return redirect()->route('email_templates.index')
                         ->with('success', 'Template criado com sucesso!');
    }

    public function edit(EmailTemplate $emailTemplate)
    {
        return view('email_templates.edit', compact('emailTemplate'));
    }

    public function update(Request $request, EmailTemplate $emailTemplate)
    {
        $request->validate([
            'subject' => 'required',
            'body' => 'required',
        ]);

        $emailTemplate->update($request->all());

        return redirect()->route('email_templates.index')
                         ->with('success', 'Template atualizado!');
    }
}