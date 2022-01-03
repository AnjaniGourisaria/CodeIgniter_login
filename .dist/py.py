# # Import Module
# from tkinter import *
# from PIL import Image, ImageTk

# # Create Tkinter Object
# root = Tk()

# # Read the Image
# image = Image.open('C:/Users/DELL/Pictures/bash.PNG')

# # Resize the image using resize() method
# resize_image = image.resize((400, 678))
# img = ImageTk.PhotoImage(resize_image)

# # create label and add resize image
# label1 = Label(image=img)
# label1.image = img
# label1.pack()

# # Execute Tkinter
# root.mainloop()

 
a= []
a= 12,12,17,12,87

for i in a:
    # print(str(i) +"    ::    "+ str(a))
    if i == 12:
        print("Panner Ka Sabji ",str(i) )
    elif i == 17:
        print("Soup ",str(i))
    elif i == 87:
        print("Sabji ",str(i))
    elif i == 43:
        print("Pokada ",str(i))
    else:
        print("Unknown")
        