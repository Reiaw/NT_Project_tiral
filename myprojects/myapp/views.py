from django.shortcuts import render,redirect
from myapp.models import Person
from django.contrib import messages

# Create your views here.
def index(request):
    all_person = Person.objects.all()
    return render(request,"index.html",{"all_person":all_person})

def form(request):
    if request.method == "POST":
        name = request.POST["name"]
        age = request.POST["age"]
        
        person = Person.objects.create(
            name=name,
            age=age
        )
        person.save()
        messages.success(request,"บันทึกข้อมูลสำเร็จ")
        return redirect("/")
    else :
        return render(request,"form.html")
    
def edit(request,person_id):
    if request.method == "POST":
        person = Person.objects.get(id=person_id)
        person.name = request.POST["name"]
        person.age = request.POST["age"]
        person.save()
        messages.success(request,"อัพเดทข้อมูลสำเร็จ")
        return redirect("/")
    else: 
        person = Person.objects.get(id=person_id)
        return render(request,"edit.html",{"person":person})
    
def delete(request,person_id):
    person = Person.objects.get(id=person_id)
    person.delete()
    messages.success(request,"ลบข้อมูลสำเร็จ")
    return redirect("/")